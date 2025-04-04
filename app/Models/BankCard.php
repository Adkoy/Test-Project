<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankCard extends Model
{
    protected $fillable = ['user_uuid', 'card_number'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'user_uuid');
    }
}
