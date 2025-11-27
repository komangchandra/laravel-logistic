<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Transaction;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('unit', 'station')->latest()->get();

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::all();
        $stations = Station::all();

        return view('transactions.create', compact('units', 'stations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'transaction_type' => 'required',
            'unit_id' => 'required|exists:units,id',
            'station_id' => 'required|exists:stations,id',
            'flowmeter_start' => 'required',
            'flowmeter_end' => 'required',
            'hour_meter' => 'required',
            'driver_name' => 'required',
            'fuelman' => 'required',
            'remarks' => 'required',
        ]);

        // 🧮 Hitung nilai otomatis
        $validatedData['volume'] = $validatedData['flowmeter_end'] - $validatedData['flowmeter_start'];

        // 🕒 Set tanggal & waktu otomatis
        $validatedData['transaction_date'] = Carbon::now();
        $validatedData['transaction_time'] = Carbon::now();

        Transaction::create($validatedData);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        // return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $units = Unit::all();
        $stations = Station::all();

        return view('transactions.edit', compact('transaction', 'units', 'stations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validatedData = $request->validate([
            'unit_id' => 'required|exists:units,id',
            'station_id' => 'required|exists:stations,id',
            'flowmeter_start' => 'required',
            'flowmeter_end' => 'required',
            'hour_meter' => 'required',
            'driver_name' => 'required',
            'fuelman' => 'required',
            'remarks' => 'required',
        ]);

        // 🧮 Hitung volume otomatis
        $validatedData['volume'] = $validatedData['flowmeter_end'] - $validatedData['flowmeter_start'];

        // 🕒 Perbarui tanggal & waktu transaksi jika perlu
        $validatedData['transaction_date'] = Carbon::now();
        $validatedData['transaction_time'] = Carbon::now();

        // Jangan ubah transaction_type, gunakan yang lama
        $validatedData['transaction_type'] = $transaction->transaction_type;

        // Update transaction
        $transaction->update($validatedData);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }
    
    /**
     * Display a listing of the resource.
     */
    public function wtd()
    {
        $startOfWeek = Carbon::now()->startOfWeek();  // Senin
        $endOfWeek   = Carbon::now()->endOfWeek();    

        $transactions = Transaction::with('unit', 'station')
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->latest()
            ->get();

        return view('transactions.index', compact('transactions'));
    }



    /**
     * Display a listing of the resource.
     */
    public function mtd()
    {{
        $today = Carbon::now();

        // Tanggal 1 bulan ini
        $startOfMonth = Carbon::create($today->year, $today->month, 1)->startOfDay();

        // Sampai hari ini
        $endOfMonth = $today->endOfDay();

        // Ambil transaksi dari tgl 1 sampai hari ini
        $transactions = Transaction::with('unit', 'station')
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->latest()
            ->get();

        return view('transactions.index', compact('transactions'));
    }}

}
