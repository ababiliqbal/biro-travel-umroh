<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PackageDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'file_name',
        'file_path',
        'document_type',
    ];

    /**
     * Relasi ke Package (Many to One)
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Hapus file fisik ketika dokumen dihapus
     */
    protected static function booted()
    {
        static::deleting(function ($document) {
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
        });
    }

    /**
     * Accessor untuk mendapatkan URL file
     */
    public function getFileUrlAttribute()
    {
        return Storage::url($this->file_path);
    }
}
