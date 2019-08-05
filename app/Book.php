<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $timestamps = false;
    public function authors()
    {
        return $this->belongsToMany('App\Author', 'authors_books', 'bid', 'aid');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment', 'bid');
    }

    public function authorsCountRelation()
    {
        return $this->belongsToMany('App\Author', 'authors_books', 'bid', 'aid');
    }
}
