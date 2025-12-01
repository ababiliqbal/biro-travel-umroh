<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'cover_image_path',
        'description',
        'price',
        'quota',
        'payment_due_days',
        'departure_date',
        'departure_location',
        'facilities',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'price' => 'integer',
        'quota' => 'integer',
        'payment_due_days' => 'integer',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function documents()
    {
        return $this->hasMany(PackageDocument::class);
    }

    public function getSisaKuotaAttribute()
    {
        $taken = $this->bookings()->where('status', '!=', 'rejected')->count();

        return $this->quota - $taken;
    }
}
