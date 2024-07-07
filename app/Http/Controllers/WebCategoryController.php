<?php

namespace App\Http\Controllers;

use App\Models\PlantCategory;
use Illuminate\Http\Request;

class WebCategoryController extends Controller
{
    public function index()
    {
        $categories = PlantCategory::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        PlantCategory::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        $category = PlantCategory::findOrFail($id);
        return view('categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = PlantCategory::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = PlantCategory::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = PlantCategory::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
