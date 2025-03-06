<?php

namespace App\Presentation\Http\Controllers\Dashboard;

use App\Application\Commands\Dashboard\GetDashboardCommand;
use App\Presentation\Http\Controllers\Controller;
use Illuminate\Support\Facades\Bus;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->guard('admin')->user();

        if (cache()->has('dashboard_home')) {
            $getAnalysisReponse = cache()->get('dashboard_home');
        } else {
            $getAnalysisCommand = new GetDashboardCommand();
            $getAnalysisReponse = Bus::dispatch($getAnalysisCommand);
            $getAnalysisReponse = $getAnalysisReponse->toArray();

            cache()->put(
                'dashboard_home',
                $getAnalysisReponse,
                now()->addMinutes(60)
            );
        }

        return view('dashboard.home', [
            ...$getAnalysisReponse,
            'user' => $user,
        ]);
    }
}
