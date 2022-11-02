<?php

namespace App\Neo4j;

use NeoEloquent;

class FilmNeo extends NeoEloquent {
    use TraitConnection;

    protected $label = 'Films';
    protected $connection = 'neo4j';
    
    public function categories()
    {
        return $this->belongsToMany('Categories', 'HAS_CATEGORY');
    }
}