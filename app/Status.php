<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $fillable = ['id', 'user_id', 'online', 'banned'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
