@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-md max-w-2xl">
    <h1 class="text-3xl font-bold mb-6 text-center">Location Details</h1>
    <div class="space-y-4">
        <p><strong class="font-semibold">Name:</strong> <span class="text-gray-700">{{ $location->location_name }}</span></p>
        <p><strong class="font-semibold">Latitude:</strong> <span class="text-gray-700">{{ $location->latitude }}</span></p>
        <p><strong class="font-semibold">Longitude:</strong> <span class="text-gray-700">{{ $location->longitude }}</span></p>
        <a href="{{ route('locations.index') }}" class="inline-block mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to List</a>
    </div>
</div>
@endsection