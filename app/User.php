<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles() {
        return $this->hasMany('\App\Article');
    }

    public function info() {
        return $this->hasOne('\App\Info');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /*public function comments() {
        return $this->hasMany('\App\Comment');
    }*/
}
