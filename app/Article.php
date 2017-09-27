<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table = 'article';
    protected $fillable = ['title', 'content'];

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}