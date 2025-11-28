<?php

namespace App\Http\Controllers;

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

        return view('stations.index', compact('stations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'station_name' => 'required|string|max:255',
            'flow_meter' => 'required|string|max:255',
        ]);

        Station::create([
            'station_name' => $request->station_name,
            'flow_meter' => $request->flow_meter,
        ]);

        return redirect()->route('stations.index')->with('success', 'Station created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Station $station)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Station $station)
    {
        return view('stations.edit', compact('station'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Station $station)
    {
        $request->validate([
            'station_name' => 'required|string|max:255',
            'flow_meter' => 'required|string|max:255',
        ]);

        $station->update([
            'station_name' => $request->station_name,
            'flow_meter' => $request->flow_meter,
        ]);

        return redirect()->route('stations.index')->with('success', 'Station created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Station $station)
    {
        $station->delete();

        return redirect()->route('stations.index')->with('success', 'Station deleted successfully.');
    }
}
