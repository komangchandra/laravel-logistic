<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stations = Station::all();

        return response()->json($stations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $station = Station::find($id);

        if (! $station) {
            return response()->json([
                'message' => 'Station not found',
            ], 404);
        }

        return response()->json($station);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Cari data station berdasarkan ID
        $station = Station::find($id);

        // Jika tidak ditemukan, kirim respons error
        if (! $station) {
            return response()->json([
                'message' => 'Station not found',
            ], 404);
        }

        // Validasi input dari request
        $validatedData = $request->validate([
            'station_name' => 'required|string|max:255',
            'sounding' => 'required',
        ]);

        // Update data station
        $station->update($validatedData);

        // Kembalikan respons sukses
        return response()->json([
            'message' => 'Station updated successfully',
            'data' => $station,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
