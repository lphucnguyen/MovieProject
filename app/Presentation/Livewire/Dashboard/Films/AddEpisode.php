<?php

namespace App\Presentation\Livewire\Dashboard\Films;

use App\Domain\Models\Film;
use Illuminate\Support\Collection;
use Livewire\Component;

class AddEpisode extends Component
{
    public Collection $episodes;
    public int $typeFilm = 1;

    protected $rules = [
        "episodes.*.url" => "required",
        "episodes.*.api_url" => "required",
    ];

    public function addEpisode()
    {
        $this->episodes->push([
            'url' => '',
            'api_url' => '',
        ]);
    }

    public function updatedTypeFilm($type)
    {
        if ($type == 2) {
            $this->episodes = array($this->episodes[0]);
        }
    }

    public function removeEpisode($index)
    {
        $this->episodes->pull($index);
    }

    public function render()
    {
        return view('livewire.dashboard.films.add-episode');
    }

    public function mount($id)
    {
        if ($id == null) {
            $this->episodes = collect([
                [
                    'url' => '',
                    'api_url' => '',
                ]
            ]);

            return;
        }

        $film = Film::findOrFail($id);
        $this->episodes = collect($film->episodes->toArray());
    }
}
