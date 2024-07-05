<?php

namespace App\Http\Controllers;

use App\Models\PlantCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tes = PlantCategory::all();
        return response()->json([
            'status' => 'aman',
            'data' => $tes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = PlantCategory::create($validatedData);

        return response()->json([
            'status' => 'success',
            'data' => $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tes = PlantCategory::find($id);
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
            $location = PlantCategory::findOrFail($id);

            // Validasi data input
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',    
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
                'message' => 'Category not found'
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
        $location = PlantCategory::findOrFail($id);

        if (!$location) {
            return response()->json([
                'status' => 'error',
                'message' => 'Category not found'
            ], 404);
        }

        $location->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully'
        ], 200);
    }
}
