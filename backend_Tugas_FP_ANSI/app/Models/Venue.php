<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'rating',
        'location',
        'price',
        // Jika ada kolom 'sports' dalam bentuk JSON atau relasi lain, sesuaikan di sini
    ];

    /**
     * Jika Anda ingin menambahkan kolom 'sports' sebagai array (JSON cast)
     * Anda perlu menambahkan 'sports' ke fillable dan casts.
     * Contoh:
     * protected $casts = [
     * 'sports' => 'array',
     * ];
     */
}