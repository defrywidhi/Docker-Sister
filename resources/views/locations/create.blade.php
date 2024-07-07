<!DOCTYPE html>
<html>
<head>
    <title>Create Plant Location</title>
</head>
<body>
    <h1>Create Plant Location</h1>
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('locations.store') }}" method="POST">
        @csrf
        <label for="location_name">Location Name:</label>
        <input type="text" id="location_name" name="location_name" value="{{ old('location_name') }}" required>
        
        <label for="latitude">Latitude:</label>
        <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}">
        
        <label for="longitude">Longitude:</label>
        <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}">
        
        <button type="submit">Create</button>
    </form>
</body>
</html>
