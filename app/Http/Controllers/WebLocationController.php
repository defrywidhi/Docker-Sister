<?php

namespace App\Http\Controllers;

use App\Models\PlantLocation;
use Illuminate\Http\Request;

class WebLocationController extends Controller
{
    public function index()
    {
        $locations = PlantLocation::all();
        return view('locations.index', compact('locations'));
    }

    public function create()
    {
        return view('locations.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'location_name' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        PlantLocation::create($validatedData);

        return redirect()->route('locations.index')->with('success', 'Location created successfully.');
    }

    public function show($id)
    {
        $location = PlantLocation::findOrFail($id);
        return view('locations.show', compact('location'));
    }

    public function edit($id)
    {
        $location = PlantLocation::findOrFail($id);
        return view('locations.edit', compact('location'));
    }

    public function update(Request $request, $id)
    {
        $location = PlantLocation::findOrFail($id);

        $validatedData = $request->validate([
            'location_name' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $location->update($validatedData);

        return redirect()->route('locations.index')->with('success', 'Location updated successfully.');
    }

    public function destroy($id)
    {
        $location = PlantLocation::findOrFail($id);
        $location->delete();

        return redirect()->route('locations.index')->with('success', 'Location deleted successfully.');
    }
}
