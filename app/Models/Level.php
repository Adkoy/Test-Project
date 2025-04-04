<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{

    protected $fillable = ['user_uuid', 'level'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'user_uuid');
    }
}
