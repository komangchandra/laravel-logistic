<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('unit', 'station')
            ->whereDate('transaction_date', Carbon::today())
            ->latest()
            ->get();

        return response()->json($transactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'transaction_type' => 'required|string',
            'unit_id' => 'required|exists:units,id',
            'station_id' => 'required|exists:stations,id',
            'flowmeter_start' => 'required|numeric',
            'flowmeter_end' => 'required|numeric',
            'hour_meter' => 'required|numeric',
            'driver_name' => 'required|string|max:255',
            'fuelman' => 'required|string|max:255',
        ]);

        // 🧮 Hitung volume otomatis
        $validatedData['volume'] = $validatedData['flowmeter_end'] - $validatedData['flowmeter_start'];

        // 🕒 Tambahkan tanggal & waktu transaksi otomatis
        $validatedData['transaction_date'] = Carbon::now()->toDateString();
        $validatedData['transaction_time'] = Carbon::now()->toTimeString();

        // 💾 Simpan data ke database
        $transaction = Transaction::create($validatedData);

        // 🔁 Kembalikan response JSON
        return response()->json([
            'message' => 'Transaction created successfully',
            'data' => $transaction,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
