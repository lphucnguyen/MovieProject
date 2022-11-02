<?php

namespace App\Http\Controllers;

use App\Actor;
use App\Category;
use App\Film;
use App\Message;
use App\Neo4j\Connection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application Dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliderFilms = Film::with('categories')->with('ratings')->limit(10)->latest()->get();
        $categoryFilms = Category::with(['films' => function($query){
            $query->limit(10)->latest()->get();
        }])->get();

        $user = auth()->guard('web')->user();
        $suggestedFilms = [];
        $ratings = [];

        if($user != NULL){
            $connection = new Connection();
            $client = $connection->getClient();
            $query = 'MATCH (c1:Users {id:$userId})-[r1:RATED]->(f:Films)<-[r2:RATED]-(c2:Users)
                        WITH
                            SUM(r1.rating*r2.rating) as dot_product,
                            SQRT( REDUCE(x=0.0, a IN COLLECT(r1.rating) | x + a^2) ) as r1_length,
                            SQRT( REDUCE(y=0.0, b IN COLLECT(r2.rating) | y + b^2) ) as r2_length,
                            c1,c2
                        MERGE (c1)-[s:SIMILARITY]-(c2)
                        SET s.similarity = dot_product / (r1_length * r2_length)
                        WITH 1 as neighbours
                        MATCH (c1)-[:SIMILARITY]->(c2)-[r:RATED]->(f2:Films)
                        WHERE NOT (c1)-[:RATED]->(f2)
                        WITH f2, collect(r) as ratings ,c2, c1
                        WITH f2, c2, REDUCE(s=0,i in ratings | s+i.rating) / SIZE(ratings) as recommendation, c1
                        RETURN f2, recommendation 
                        ORDER BY recommendation DESC
                        LIMIT 10';
            $param = ['userId' => $user->id];
            $results = $client->run($query, $param);
            foreach ($results as $result) {
                $node = $result->get('f2');
                $ratings[] = $result->get('recommendation');
                $suggestedFilms[] = $node;
            }
    
            // dd($suggestedFilms);
        }

        return view('home', compact('sliderFilms', 'categoryFilms', 'suggestedFilms', 'ratings'));
    }

    public function search(Request $request)
    {
        switch ($request->search_category) {
            case 'movies':
                $films = Film::where('name', 'like', '%' . $request->search . '%')->paginate(10);
                return view('movies.index', compact('films'));
                break;
            case 'actors':
                $actors = Actor::where('name', 'like', '%' . $request->search . '%')->paginate(10);
                return view('actors.index', compact('actors'));
                break;
            default:
                return redirect()->back();
        }
    }

    public function message(Request $request){
        $attributes = $request->validate([
            'email' =>  'required|email',
            'title'=>  'required|string',
            'message'=>  'required|string|max:250'
        ]);

        Message::create([
           'email' => $attributes['email'],
           'title' => $attributes['title'],
           'message' => $attributes['message'],
        ]);

        session()->flash('success', 'Cám ơn bạn đã liên hệ');
        return redirect()->back();
    }

    public function contact() {
        return view('contact.index');
    }

}
