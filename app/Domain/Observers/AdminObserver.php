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

    public function deleting(Admin $model)
    {
        $attributes = $model->getAttributes();
        Storage::delete($attributes['avatar']);
    }

    public function updating(Admin $model)
    {
        if ($model->isDirty('avatar')) {
            Storage::delete($model->getRawOriginal('avatar'));
        }
    }
}
