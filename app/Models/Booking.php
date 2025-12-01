<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'registered_by',
        'status',
        'total_price',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    // Relasi: Booking milik satu User (Jemaah)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Booking milik satu Paket
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    // Relasi: Booking didaftarkan oleh satu User (Staf) - Opsional
    public function registrar()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    // Relasi ke Payments (Akan kita buat nanti)
    // Satu Booking bisa punya banyak history pembayaran
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
