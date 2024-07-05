<?php

namespace App\Http\Controllers;

use App\Models\Plantys;
use Illuminate\Http\Request;

class PlantysController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plants = Plantys::with(['category', 'location'])->get();
        return response()->json([
            'status' => 'Aman brok',
            'data' => $plants
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'scientific_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'habitat' => 'nullable|string',
            'category_id' => 'required|exists:plant_categories,id',
            'location_id' => 'required|exists:plant_locations,id',
        ]);

        $plant = Plantys::create($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $plant
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $plant = Plantys::with(['category', 'location'])->find($id);

        if (!$plant) {
            return response()->json([
                'status' => 'error',
                'message' => 'Plant not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $plant
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $plant = Plantys::find($id);

        if (!$plant) {
            return response()->json([
                'status' => 'error',
                'message' => 'Plant not found'
            ], 404);
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'scientific_name' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'habitat' => 'nullable|string',
            'category_id' => 'required|exists:plant_categories,id',
            'location_id' => 'required|exists:plant_locations,id',
        ]);

        $plant->update($validatedData);
        return response()->json([
            'status' => 'success',
            'data' => $plant
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plant = Plantys::find($id);

        if (!$plant) {
            return response()->json([
                'status' => 'error',
                'message' => 'Plant not found'
            ], 404);
        }

        $plant->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Plant deleted successfully'
        ], 200);
    }
}
