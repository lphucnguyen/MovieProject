<?php

namespace App\Domain\Observers;

use App\Domain\Models\Admin;
use Illuminate\Support\Facades\Storage;

class AdminObserver
{
    public function creating(Admin $model)
    {
        $model->id = str()->uuid();
    }

    // public function deleting(Admin $model)
    // {
    //     if ($model->getRawOriginal('avatar') !== null) {
    //         Storage::delete($model->getRawOriginal('avatar'));
    //     }
    // }

    // public function updating(Admin $model)
    // {
    //     if ($model->isDirty('avatar') && $model->getRawOriginal('avatar') !== null) {
    //         Storage::delete($model->getRawOriginal('avatar'));
    //     }
    // }
}
