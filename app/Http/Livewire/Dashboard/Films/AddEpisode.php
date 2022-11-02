<?php

namespace App\Http\Livewire\Dashboard\Films;

use App\Episode;
use App\Film;
use Livewire\Component;

class AddEpisode extends Component
{
    public $episodes;
    public $typeFilm = 1;

    protected $rules = [
        "episodes.*.url" => "required",
        "episodes.*.api_url" => "required",
    ];

    public function addEpisode() {
        $newEpisode = Episode::make();

        $this->episodes[] = $newEpisode;
    }

    public function updatedTypeFilm($type) {
        if($type == 2){
            $this->episodes = array($this->episodes[0]);
        }
    }

    public function removeEpisode($index) {
        if(!isset($this->episodes[$index])) return;

        array_splice($this->episodes, $index, 1);
    }

    public function render()
    {
        return view('livewire.dashboard.films.add-episode');
    }

    public function mount($id) {
        try{
            $film = Film::findOrFail($id);

            $this->episodes = $film->episodes->all();
        }catch(\Exception $e){
            $this->addEpisode();
        }
    }
}
