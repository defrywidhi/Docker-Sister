<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Plant</title>
    <!-- Link to Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-center">Edit Plant</h1>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                <strong>Validation errors:</strong>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Edit Plant -->
        <form action="{{ route('plants.update', $plant->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $plant->name) }}" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
                <textarea id="description" name="description" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $plant->description) }}</textarea>
            </div>

            <!-- Scientific Name -->
            <div>
                <label for="scientific_name" class="block text-gray-700 font-bold mb-2">Scientific Name:</label>
                <input type="text" id="scientific_name" name="scientific_name" value="{{ old('scientific_name', $plant->scientific_name) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Location -->
            {{-- <div>
                <label for="location" class="block text-gray-700 font-bold mb-2">Location:</label>
                <input type="text" id="location" name="location" value="{{ old('location', $plant->location) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div> --}}

            <!-- Habitat -->
            <div>
                <label for="habitat" class="block text-gray-700 font-bold mb-2">Habitat:</label>
                <textarea id="habitat" name="habitat" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('habitat', $plant->habitat) }}</textarea>
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-gray-700 font-bold mb-2">Category:</label>
                <select id="category_id" name="category_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ (old('category_id', $plant->category_id) == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Location ID -->
            <div>
                <label for="location_id" class="block text-gray-700 font-bold mb-2">Location:</label>
                <select id="location_id" name="location_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ (old('location_id', $plant->location_id) == $location->id) ? 'selected' : '' }}>
                            {{ $location->location_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Image -->
            <div>
                <label for="image" class="block text-gray-700 font-bold mb-2">Image:</label>
                <input type="file" id="image" name="image" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Current Image -->
            <div class="mt-4">
                <label class="block text-gray-700 font-bold mb-2">Current Image:</label>
                @if ($plant->image)
                    <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->name }}" class="w-32 h-32 object-cover rounded-lg">
                @else
                    <p class="text-gray-600">No image found.</p>
                @endif
            </div>

            <!-- Update Button -->
            <div class="text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Plant</button>
            </div>
        </form>
    </div>
</body>
</html>
