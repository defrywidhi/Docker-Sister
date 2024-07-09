<!DOCTYPE html>
<html>
<head>
    <title>Create Plant Location</title>
    <!-- Tambahkan link ke Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 py-6">
    <div class="max-w-2xl mx-auto bg-white p-8 shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-center">Create Plant Location</h1>
        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('locations.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="location_name" class="block text-gray-700 font-semibold mb-2">Location Name:</label>
        <input type="text" id="location_name" name="location_name" value="{{ old('location_name') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" required>
        @error('location_name')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="latitude" class="block text-gray-700 font-semibold mb-2">Latitude:</label>
        <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        <!-- Tambahkan validasi jika ada -->
    </div>
    <div class="mb-4">
        <label for="longitude" class="block text-gray-700 font-semibold mb-2">Longitude:</label>
        <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
        <!-- Tambahkan validasi jika ada -->
    </div>
    
    <button type="submit"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        Create
    </button>
</form>


    </div>
</body>
</html>
