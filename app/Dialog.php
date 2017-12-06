<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    protected $table = 'dialogs';
    protected $fillable = ['id', 'talkers'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function messages() {
        return $this->hasMany('\App\Message');
    }

    public function lastMsg() {
        return $this->hasOne('\App\Message')->latest();
    }
}
