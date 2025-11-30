<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageDocument extends Model
{
    protected $fillable = [
        'package_id',
        'file_name',
        'file_path',
        'document_type',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
