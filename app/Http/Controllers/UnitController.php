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
        return view('units.create');
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
        ]);

        Unit::create([
            'unit_id' => $request->unit_id,
            'nomor_lambung' => $request->nomor_lambung,
            'unit_name' => $request->unit_name,
            'status' => $request->status,
            'area' => $request->area,
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
        return view('units.edit', compact('unit'));
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
        ]);

        $unit->update([
            'unit_id' => $request->unit_id,
            'nomor_lambung' => $request->nomor_lambung,
            'unit_name' => $request->unit_name,
            'status' => $request->status,
            'area' => $request->area,
        ]);

        return redirect()->route('units.index')->with('success', 'Unit updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withInput()->with('error', 'ID Kartu sudah terdaftar atau input tidak valid.');
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
