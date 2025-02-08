<?php

namespace App\Domain\Observers;

use App\Domain\Events\Film\FilmCreated;
use App\Domain\Events\Film\FilmDeleted;
use App\Domain\Events\Film\FilmUpdated;

use App\Domain\Models\Film;
use App\Shared\Traits\ModelUpdateable;
use Illuminate\Support\Facades\Storage;

class FilmObserver
{
    use ModelUpdateable;

    public function creating(Film $model)
    {
        $model->id = str()->uuid();
    }

    public function created(Film $model)
    {
        event(new FilmCreated($model->id, $model->name, $model->overview, $model->poster, $model->background_cover));
    }

    public function updating(Film $model)
    {
        if ($model->isDirty('background_cover')) {
            Storage::delete($model->getRawOriginal('background_cover'));
        }

        if ($model->isDirty('poster')) {
            Storage::delete($model->getRawOriginal('poster'));
        }
    }

    public function updated(Film $model)
    {
        if (!$this->isUpdate($model)) {
            return;
        }

        event(new FilmUpdated($model->id, $model->name, $model->overview, $model->poster, $model->background_cover));
    }

    public function deleting(Film $model)
    {
        $attributes = $model->getAttributes();

        Storage::delete($attributes['background_cover']);
        Storage::delete($attributes['poster']);
    }

    public function deleted(Film $model)
    {
        event(new FilmDeleted($model->id));
    }
}
