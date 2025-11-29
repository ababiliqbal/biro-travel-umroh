<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cover_image_path',
        'description',
        'price',
        'quota',
        'departure_date',
        'facilities',
    ];

    /**
     * Relasi ke PackageDocument (One to Many)
     */
    public function documents()
    {
        return $this->hasMany(PackageDocument::class, 'package_id');
    }

    public function photos()
    {
        return $this->hasMany(PackageDocument::class)->where('document_type', 'photo');
    }


}
