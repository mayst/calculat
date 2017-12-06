<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';
    protected $fillable = ['id', 'user_id', 'type', 'name'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
