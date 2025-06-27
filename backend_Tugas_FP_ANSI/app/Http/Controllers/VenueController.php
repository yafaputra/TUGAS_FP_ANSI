<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Untuk pencarian, kita akan menyesuaikan query berdasarkan parameter yang diterima
        $query = Venue::query();

        if ($request->has('venue_name') && $request->venue_name != '') {
            $query->where('title', 'like', '%' . $request->venue_name . '%');
        }

        if ($request->has('city') && $request->city != '') {
            $query->where('location', 'like', '%' . $request->city . '%');
        }

        // Untuk sport, ini sedikit lebih kompleks karena 'sports' kemungkinan disimpan sebagai JSON di kolom 'sports' (jika Anda menambahkannya)
        // Jika 'sports' adalah kolom terpisah atau relasi, logika ini perlu disesuaikan.
        // Untuk demo ini, kita asumsikan 'sports' disimpan di tabel lain atau dalam format JSON di kolom 'sports' pada tabel venues.
        // Jika 'sports' adalah array di kolom 'sports' (json_cast), Anda bisa melakukan:
        // if ($request->has('sport') && $request->sport != '') {
        //     $query->whereJsonContains('sports', $request->sport);
        // }
        // Jika tidak ada kolom 'sports' di DB Anda, abaikan bagian ini atau pertimbangkan untuk menambahkannya.

        $venues = $query->paginate(12); // Ambil 12 venue per halaman

        return response()->json($venues);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Contoh untuk membuat venue baru (jika dibutuhkan)
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|url', // Asumsi image adalah URL
            'rating' => 'numeric|min:0|max:5',
            'location' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            // 'sports' => 'nullable|array', // Jika ada kolom sports (array/json)
        ]);

        $venue = Venue::create($validatedData);

        return response()->json($venue, 201); // 201 Created
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {
        return response()->json($venue);
    }

    // Anda bisa menambahkan method update dan delete jika diperlukan
}