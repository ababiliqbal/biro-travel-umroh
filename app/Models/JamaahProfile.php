<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JamaahProfile extends Model
{
    protected $fillable = [
        'user_id',
        'ktp_number',
        'passport_number',
        'phone_number',
        'address',
        'date_of_birth',
    ];
}
