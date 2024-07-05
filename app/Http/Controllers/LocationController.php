<?php

namespace App\Http\Controllers;

use App\Models\PlantLocation;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tes = PlantLocation::all();
        if($tes){
            return response()->json([
                'status' => 'OKE',
                'data' => $tes
            ], 200);
        } else{
            return response()->json([
                'status' => 'NO DATA IN THIS TABLE',
            ], 400);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'location_name' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        $location = PlantLocation::create($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $location
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tes = PlantLocation::find($id);
        if($tes){
            return response()->json([
                'status' => 'OKE',
                'data' => $tes
            ], 200);
        } else{
            return response()->json([
                'status' => 'dunno',
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Mencari lokasi berdasarkan ID
            $location = PlantLocation::findOrFail($id);

            // Validasi data input
            $validatedData = $request->validate([
                'location_name' => 'required|string|max:255',
                'latitude' => 'nullable|numeric|between:-90,90',
                'longitude' => 'nullable|numeric|between:-180,180',
            ]);

            // Update data lokasi dengan data yang telah divalidasi
            $location->update($validatedData);

            // Mengembalikan response sukses
            return response()->json([
                'status' => 'success',
                'data' => $location
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Menangani kasus ketika lokasi tidak ditemukan
            return response()->json([
                'status' => 'error',
                'message' => 'Location not found'
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Menangani kasus validasi gagal
            return response()->json([
                'status' => 'error',
                'message' => 'Validation error',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Menangani semua kasus kesalahan lainnya
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = PlantLocation::findOrFail($id);

        if (!$location) {
            return response()->json([
                'status' => 'error',
                'message' => 'Location not found'
            ], 404);
        }

        $location->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Location deleted successfully'
        ], 200);
    }
}
