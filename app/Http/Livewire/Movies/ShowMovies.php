<?php

namespace App\Http\Livewire\Movies;

use App\Film;
use Livewire\Component;

class ShowMovies extends Component
{
    public $episodes;
    public $currentEpisode;

    public function render()
    {
        return view('livewire.movies.show-movies');
    }

    public function selectEpisode($index)
    {
        $currentEps = $this->episodes->get($index);

        if ($currentEps == null) {
            return;
        }

        $this->currentEpisode = $currentEps;

        $this->dispatchBrowserEvent('initEmbed', ['url' => $currentEps->url]);
    }

    public function mount($id)
    {
        $this->episodes = collect();

        $film = Film::findOrFail($id);
        $this->episodes = $film->episodes;
        $firstEpisode = $this->episodes->first();
        $this->currentEpisode = $firstEpisode;
    }
}
