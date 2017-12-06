<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';
    protected $fillable = ['id', 'user_id', 'notification'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
