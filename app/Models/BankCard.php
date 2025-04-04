<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankCard extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_uuid',
        'card_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'user_uuid');
    }
}
