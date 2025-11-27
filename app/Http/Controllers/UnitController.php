<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::all();

        // dd($units);
        return view('units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $activities = [
            "Coal Getting",
            "Coal Hauling",
            "CCP",
            "OB Removal",
            "Maintenance Road",
            "Office & Mess",
            "Lainnya",
        ];
        return view('units.create', compact('activities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'unit_id' => 'required|unique:units,unit_id',
                'nomor_lambung' => 'required',
                'unit_name' => 'required',
                'status' => 'required',
                'area' => 'required',
                'activity' => 'required',
            ]);

            Unit::create([
                'unit_id' => $request->unit_id,
                'nomor_lambung' => $request->nomor_lambung,
                'unit_name' => $request->unit_name,
                'status' => $request->status,
                'area' => $request->area,
                'activity' => $request->activity,
            ]);

            return redirect()->route('units.index')->with('success', 'Unit created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withInput()->with('error', 'ID Kartu sudah terdaftar atau input tidak valid.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        $activities = 
        [
            "Coal Getting",
            "Coal Hauling",
            "CCP",
            "OB Removal",
            "Maintenance Road",
            "Office & Mess",
            "Lainnya",
        ];

        return view('units.edit', compact('unit', 'activities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        try {
            $request->validate([
                'unit_id' => 'required|unique:units,unit_id,'.$unit->id,
                'nomor_lambung' => 'required',
                'unit_name' => 'required',
                'status' => 'required',
                'area' => 'required',
                'activity' => 'required',
                'is_activ' => 'required'
            ]);

            $unit->update([
                'unit_id' => $request->unit_id,
                'nomor_lambung' => $request->nomor_lambung,
                'unit_name' => $request->unit_name,
                'status' => $request->status,
                'area' => $request->area,
                'activity' => $request->activity,
                'is_activ' => $request->is_activ,
            ]);

            return redirect()->route('units.index')->with('success', 'Unit updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan | Terdapat kesalahan data!.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();

        return redirect()->route('units.index')->with('success', 'Unit deleted successfully.');
    }
}
