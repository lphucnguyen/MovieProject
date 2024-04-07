<?php

namespace App\Neo4j;

use NeoEloquent;

class CategoryNeo extends NeoEloquent
{
    use TraitConnection;

    protected $label = 'Categories';


    public function films()
    {
        return $this->belongsToMany('Films', 'HAS_CATEGORY');
    }
}