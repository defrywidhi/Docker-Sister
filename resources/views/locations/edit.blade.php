<!DOCTYPE html>
<html>
<head>
    <title>Edit Plant Location</title>
</head>
<body>
    <h1>Edit Plant Location</h1>
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('locations.update', $location->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="location_name">Location Name:</label>
        <input type="text" id="location_name" name="location_name" value="{{ old('location_name', $location->location_name) }}" required>
        
        <label for="latitude">Latitude:</label>
        <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $location->latitude) }}">
        
        <label for="longitude">Longitude:</label>
        <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $location->longitude) }}">
        
        <button type="submit">Update</button>
    </form>
</body>
</html>
