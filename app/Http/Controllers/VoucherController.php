<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vouchers = Voucher::with('user')->get();
        // dd($vouchers);
        return view('vouchers.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stations = Station::all();
        return view('vouchers.create', compact('stations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('here');
        $data = $request->validate([
            'unit_name' => 'required|string|max:255',
            'station_id' => 'nullable|exists:stations,id',
            'flowmeter_start' => 'nullable|integer',
            'flowmeter_end' => 'nullable|integer',
            'volume' => 'required|integer',
            'hour_meter' => 'nullable|numeric',
            'transaction_date' => 'nullable|date',
            'transaction_time' => 'nullable',
            'driver_name' => 'nullable|string|max:255',
            'fuelman' => 'nullable|string|max:255',
            'remarks' => 'nullable|string|max:255',
        ]);

        // dd($data);

        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        Voucher::create($data);

        return redirect()->route('vouchers.index')->with('success', 'Voucher created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Voucher $voucher)
    {
        return view('vouchers.show', compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Voucher $voucher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voucher $voucher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        //
    }
}
