<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $voucher = Voucher::find($id);
        if (! $voucher) {
            return response()->json([
                'message' => 'Voucher not found',
            ], 404);
        }

        return response()->json($voucher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Force API Mode tanpa middleware
        // $request->headers->set('Accept', 'application/json');

        $voucher = Voucher::find($id);

        if (! $voucher) {
            return response()->json([
                'message' => 'Voucher not found',
            ], 404);
        }

        // ⛔ CEK STATUS — Jika sudah SCANNED, tolak update
        if ($voucher->status === 'scanned') {
            return response()->json([
                'message' => 'Voucher sudah pernah discan sebelumnya',
            ], 403);
        }

        $data = $request->validate([
            'station_id' => 'required|exists:stations,id',
            'flowmeter_start' => 'required|integer',
            'hour_meter' => 'required|numeric',
            'transaction_date' => 'required|date',
            'transaction_time' => 'required',
            'driver_name' => 'required|string|max:255',
            'fuelman' => 'required|string|max:255',
            'remarks' => 'required|string|max:255',
        ]);

        $data['flowmeter_end'] = $data['flowmeter_start'] + $voucher->volume;
        $data['status'] = 'scanned';

        $voucher->update($data);

        return response()->json([
            'message' => 'Voucher updated successfully',
            'data' => $voucher,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
