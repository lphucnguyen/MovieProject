<?php

namespace App;

use App\Traits\ExtendedModel;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use ExtendedModel;

    protected $table = 'categories';

    protected $keyType = 'string';

    protected $fillable = ['name'];

    protected static function booted()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = str()->uuid();
        });
    }

    public function films()
    {
        return $this->belongsToMany(Film::class, 'film_category');
    }
}
