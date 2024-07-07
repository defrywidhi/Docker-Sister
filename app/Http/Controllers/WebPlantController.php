<?php

namespace App\Http\Controllers;

use App\Models\PlantCategory;
use App\Models\PlantLocation;
use App\Models\Plantys;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebPlantController extends Controller
{
    public function index()
    {
        $plants = Plantys::with('category', 'location')->get();
        // dd($plants);
        return view('plants.index', compact('plants'));

    //     $plants = Plantys::with('category', 'location')->get();
    // dd($plants); // Debugging: lihat data yang diambil
    // return view('plants.index', compact('plants'));
    }

    public function create()
    {
        $categories = PlantCategory::all();
        $locations = PlantLocation::all();
        return view('plants.create', compact('categories', 'locations'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'scientific_name' => 'nullable|string|max:255',
            // 'location' => 'nullable|string|max:255',
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

        Plantys::create($validatedData);

        return redirect()->route('plants.index')->with('success', 'Plant created successfully.');
    }

    public function show($id)
    {
        $plant = Plantys::with('category', 'location')->findOrFail($id);
        return view('plants.show', compact('plant'));
    }

    public function edit($id)
    {
        $plant = Plantys::findOrFail($id);
        $categories = PlantCategory::all();
        $locations = PlantLocation::all();
        return view('plants.edit', compact('plant', 'categories', 'locations'));
    }

    public function update(Request $request, $id)
    {
        $plant = Plantys::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'scientific_name' => 'nullable|string|max:255',
            // 'location' => 'nullable|string|max:255',
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

        return redirect()->route('plants.index')->with('success', 'Plant updated successfully.');
    }

    public function destroy($id)
    {
        $plant = Plantys::findOrFail($id);

        if ($plant->image) {
            Storage::disk('public')->delete($plant->image);
        }

        $plant->delete();

        return redirect()->route('plants.index')->with('success', 'Plant deleted successfully.');
    }
}
