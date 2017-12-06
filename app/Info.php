<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    //
    protected $table = 'personal_info';
    protected $fillable = ['id', 'user_id', 'male', 'age', 'country', 'city', 'height', 'weight', 'zodiac', 'hair_color',
        'body_type', 'eyes_color', 'skin_color', 'marital_status', 'children', 'attitude_to_alcohol',
        'attitude_to_smoking', 'religious_views', 'about_me', 'my_desire', 'education', 'job', 'position', 'i_live',
        'my_priorities', 'hobby', 'love_too'];

    public function user() {
        return $this->belongsTo('\App\User');
    }

    public function favorite() {
        return $this->hasMany('\App\Favorite', 'favorite_id');
    }
}
