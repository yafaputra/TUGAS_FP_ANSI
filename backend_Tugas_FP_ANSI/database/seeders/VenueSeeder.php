<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venue; // Import model Venue
use Illuminate\Support\Facades\DB; // Opsional jika ingin menggunakan DB facade

class VenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama (opsional, jika Anda ingin bersih setiap kali seed)
        // Venue::truncate(); // Ini akan menghapus semua data dan mereset auto-increment ID

        $venues = [
            [
                'title' => "Metro Atom Futsal Badminton",
                'image' => "https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=220&fit=crop",
                'rating' => 4.89,
                'location' => "Kota Jakarta Pusat",
                'price' => 70000,
                // 'sports' => json_encode(["Futsal", "Badminton"]), // Jika ada kolom sports (JSON)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => "Centro Sawah Besar",
                'image' => "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=220&fit=crop",
                'rating' => 4.70,
                'location' => "Kota Jakarta Barat",
                'price' => 90000,
                // 'sports' => json_encode(["Futsal"]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => "Gala Sport Asem Reges",
                'image' => "https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=400&h=220&fit=crop",
                'rating' => 4.44,
                'location' => "Kota Jakarta Barat",
                'price' => 50000,
                // 'sports' => json_encode(["Futsal", "Badminton"]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => "Olympic Futsal Arena",
                'image' => "https://images.unsplash.com/photo-1551698618-1dfe5d97d256?w=400&h=220&fit=crop",
                'rating' => 4.92,
                'location' => "Kota Jakarta Selatan",
                'price' => 85000,
                // 'sports' => json_encode(["Futsal", "Basketball"]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => "Wisma Badminton Center",
                'image' => "https://images.unsplash.com/photo-1544725176-7c40e5a71c5e?w=400&h=220&fit=crop",
                'rating' => 4.65,
                'location' => "Kota Jakarta Timur",
                'price' => 45000,
                // 'sports' => json_encode(["Badminton"]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => "Grand Slam Tennis Club",
                'image' => "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=220&fit=crop",
                'rating' => 4.78,
                'location' => "Kota Jakarta Utara",
                'price' => 120000,
                // 'sports' => json_encode(["Tennis", "Squash"]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => "Victory Basketball Court",
                'image' => "https://images.unsplash.com/photo-1579952363873-27d3bfad9c0d?w=400&h=220&fit=crop",
                'rating' => 4.56,
                'location' => "Kota Tangerang",
                'price' => 60000,
                // 'sports' => json_encode(["Basketball", "Volleyball"]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => "Mega Futsal Complex",
                'image' => "https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=220&fit=crop",
                'rating' => 4.81,
                'location' => "Kota Bekasi",
                'price' => 75000,
                // 'sports' => json_encode(["Futsal", "Mini Soccer"]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => "Elite Badminton Hall",
                'image' => "https://images.unsplash.com/photo-1544725176-7c40e5a71c5e?w=400&h=220&fit=crop",
                'rating' => 4.73,
                'location' => "Kota Depok",
                'price' => 55000,
                // 'sports' => json_encode(["Badminton", "Table Tennis"]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => "Champions Sports Arena",
                'image' => "https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=220&fit=crop",
                'rating' => 4.67,
                'location' => "Kota Bogor",
                'price' => 65000,
                // 'sports' => json_encode(["Futsal", "Badminton", "Basketball"]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => "Premier Volleyball Center",
                'image' => "https://images.unsplash.com/photo-1551698618-1dfe5d97d256?w=400&h=220&fit=crop",
                'rating' => 4.59,
                'location' => "Kota Bandung",
                'price' => 80000,
                // 'sports' => json_encode(["Volleyball", "Basketball"]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => "Ultimate Sports Complex",
                'image' => "https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=400&h=220&fit=crop",
                'rating' => 4.85,
                'location' => "Kota Surabaya",
                'price' => 95000,
                // 'sports' => json_encode(["Futsal", "Badminton", "Tennis"]),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        foreach ($venues as $venue) {
            Venue::create($venue);
        }
    }
}