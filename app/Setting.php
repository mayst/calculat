<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = ['id', 'user_id', 'phone', 'lang', 'tariff', 'end_date_tariff'];

    public function user() {
        return $this->belongsTo('App\User');
    }
}
