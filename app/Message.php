<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['id', 'user_id', 'message', 'receiver', 'type', 'status', 'dialog_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function recipient() {
        return $this->belongsTo('App\User', 'receiver');
    }

    public function dialog() {
        return $this->belongsTo('App\Dialog');
    }
}
