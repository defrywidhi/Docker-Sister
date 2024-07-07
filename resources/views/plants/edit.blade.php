<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Plant</title>
</head>
<body>
    <h1>Edit Plant</h1>

    @if ($errors->any())
        <div>
            <strong>Validation errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('plants.update', $plant->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $plant->name) }}" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ old('description', $plant->description) }}</textarea>
        </div>

        <div>
            <label for="scientific_name">Scientific Name:</label>
            <input type="text" id="scientific_name" name="scientific_name" value="{{ old('scientific_name', $plant->scientific_name) }}">
        </div>

        <div>
            <label for="location">Location:</label>
            <input type="text" id="location" name="location" value="{{ old('location', $plant->location) }}">
        </div>

        <div>
            <label for="habitat">Habitat:</label>
            <textarea id="habitat" name="habitat">{{ old('habitat', $plant->habitat) }}</textarea>
        </div>

        <div>
            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ (old('category_id', $plant->category_id) == $category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="location_id">Location:</label>
            <select id="location_id" name="location_id">
                @foreach ($locations as $location)
                    <option value="{{ $location->id }}" {{ (old('location_id', $plant->location_id) == $location->id) ? 'selected' : '' }}>
                        {{ $location->location_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image">
        </div>

        <div>
            Current Image:
            @if ($plant->image)
                <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->name }}" width="100">
            @else
                <p>No image found.</p>
            @endif
        </div>

        <button type="submit">Update Plant</button>
    </form>
</body>
</html>
