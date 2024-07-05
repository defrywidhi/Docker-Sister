<?php

namespace App\Http\Controllers;

use App\Models\Plantys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi untuk gambar
        ]);

        // Proses upload gambar
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

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
        // Log permintaan yang diterima
        Log::info('Update request received', [
            'id' => $id, 
            'data' => $request->all(), 
            'files' => $request->file(),
            'content_type' => $request->header('Content-Type'),
            'request_headers' => $request->headers->all(),
            'input' => $request->all()
        ]);

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi untuk gambar
        ]);

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($plant->image) {
                Storage::disk('public')->delete($plant->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

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
