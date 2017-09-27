<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $table = 'menu';
    protected $fillable = ['title', 'parent_id', 'order'];
}