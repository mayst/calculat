<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';
    protected $fillable = ['id', 'user_id', 'favorite_id'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function favoriteUser() {
        return $this->belongsTo('\App\Info', 'favorite_id');
    }
}
