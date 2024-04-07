<?php

namespace App\Neo4j;

use NeoEloquent;

class UserNeo extends NeoEloquent
{
    use TraitConnection;

    protected $label = 'Users';

    public function films()
    {
        return $this->belongsToMany('Films', 'RATED');
    }
}