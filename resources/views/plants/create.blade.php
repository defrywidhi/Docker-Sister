<!DOCTYPE html>
<html>
<head>
    <title>Create Plant</title>
</head>
<body>
    <h1>Create Plant</h1>
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('plants.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description">{{ old('description') }}</textarea>
        
        <label for="scientific_name">Scientific Name:</label>
        <input type="text" id="scientific_name" name="scientific_name" value="{{ old('scientific_name') }}">
        
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="{{ old('location') }}">
        
        <label for="habitat">Habitat:</label>
        <textarea id="habitat" name="habitat">{{ old('habitat') }}</textarea>
        
        <label for="category_id">Category:</label>
        <select id="category_id" name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        
        <label for="location_id">Location:</label>
        <select id="location_id" name="location_id" required>
            @foreach($locations as $location)
                <option value="{{ $location->id }}">{{ $location->location_name }}</option>
            @endforeach
        </select>
        
        <label for="image">Image:</label>
        <input type="file" id="image" name="image">
        
        <button type="submit">Create</button>
    </form>
</body>
</html>
