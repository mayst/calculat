<?php

namespace App;

use Illuminate\Support\Facades\DB;
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
        'name', 'email', 'role', 'password'
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

    public function dialogs() {
        return DB::table('dialogs')->where('talkers', 'like', "$this->id %")->orWhere('talkers', 'like', "% $this->id");
    }

    public function messages()
    {
        return $this->hasMany('\App\Message');
    }

    public function receives() {
        return $this->hasMany('\App\Message', 'receiver');
    }

    public function latestMessage()
    {
        return $this->hasOne(Message::class, 'receiver')->latest();
    }

    public function avatar()
    {
        return ($photo = $this->hasOne('\App\Photo')->where('type', 'avatar')->first()) ? $photo->name : 'default_ava.jpg';
    }

    public function gallery()
    {
        return $this->hasMany('\App\Photo')->where('type', 'gallery')->get();
    }

    public function favorite() {
        return $this->hasOne('\App\Favorite');
    }

    public function favoriteUsers() {
        return $this->hasMany('\App\Favorite', 'favorite_id');
    }

    public function status() {
        return $this->hasOne('\App\Status');
    }

    public function settings() {
        return $this->hasOne('\App\Setting');
    }

    public function notifications() {
        return $this->hasMany('\App\Notification');
    }

    /*public function comments() {
        return $this->hasMany('\App\Comment');
    }*/
}
