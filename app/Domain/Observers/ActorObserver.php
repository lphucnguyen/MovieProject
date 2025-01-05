<?php

namespace App\Domain\Observers;

use App\Domain\Models\Actor;
use Illuminate\Support\Facades\Storage;

class ActorObserver
{
    public function updating(Actor $model)
    {
        if ($model->isDirty('avatar')) {
            Storage::delete($model->getRawOriginal('avatar'));
        }

        if ($model->isDirty('background_cover')) {
            Storage::delete($model->getRawOriginal('background_cover'));
        }
    }

    public function deleting(Actor $model)
    {
        $attributes = $model->getAttributes();

        Storage::delete($attributes['background_cover']);
        Storage::delete($attributes['avatar']);
    }

    public function creating(Actor $model)
    {
        $model->id = str()->uuid();
    }
}
