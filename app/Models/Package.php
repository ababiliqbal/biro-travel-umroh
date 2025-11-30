<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name',
        'cover_image_path',
        'description',
        'price',
        'quota',
        'departure_date',
        'facilities',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'price' => 'integer',
        'quota' => 'integer',
    ];

    public function documents()
    {
        return $this->hasMany(PackageDocument::class);
    }
}
