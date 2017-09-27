<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';
    protected $fillable = ['article_id', 'parent_id', 'user_id', 'message', 'created_at'];

    public function user() {
        return $this->belongsTo('\App\User');
    }
}