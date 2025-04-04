<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory,HasUuids;

    protected $primaryKey = 'user_uuid';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';


    public function bank_cards()
    {
        return $this->hasMany(BankCard::class, 'user_uuid', 'user_uuid');
    }

    public function level()
    {
        return $this->hasOne(Level::class, 'user_uuid', 'user_uuid');
    }
}
