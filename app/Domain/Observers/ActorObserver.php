<?php

namespace App\Domain\Observers;

use App\Domain\Models\Actor;
use Illuminate\Support\Facades\Storage;

class ActorObserver
{
    // public function updating(Actor $model)
    // {
    //     if ($model->isDirty('avatar') && $model->getRawOriginal('avatar') !== null) {
    //         Storage::delete($model->getRawOriginal('avatar'));
    //     }

    //     if ($model->isDirty('background_cover') && $model->getRawOriginal('background_cover') !== null) {
    //         Storage::delete($model->getRawOriginal('background_cover'));
    //     }
    // }

    // public function deleting(Actor $model)
    // {
    //     if ($model->getRawOriginal('avatar') !== null) {
    //         Storage::delete($model->getRawOriginal('avatar'));
    //     }

    //     if ($model->getRawOriginal('background_cover') !== null) {
    //         Storage::delete($model->getRawOriginal('background_cover'));
    //     }
    // }

    public function creating(Actor $model)
    {
        $model->id = str()->uuid();
    }
}
