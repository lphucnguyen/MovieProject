<?php

namespace App\Presentation\Livewire\Movies;

use App\Application\Commands\Film\GetEpisodesCommand;
use App\Domain\Models\Film;
use Illuminate\Support\Facades\Bus;
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
        $currentEpsode = $this->episodes->get($index);

        if ($currentEpsode == null) {
            return;
        }

        $this->currentEpisode = $currentEpsode;

        $this->dispatchBrowserEvent('initEmbed', ['url' => $currentEpsode->url]);
    }

    public function mount($id)
    {
        $episodes = Bus::dispatch(new GetEpisodesCommand($id));
        $this->episodes = collect($episodes->toArray());

        $firstEpisode = $this->episodes->first();
        $this->currentEpisode = $firstEpisode;
    }
}
