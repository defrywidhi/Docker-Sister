@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-md max-w-4xl">
    <h1 class="text-3xl font-bold mb-6 text-center">Plant Details</h1>
    <div class="space-y-4">
        <p><strong class="font-semibold">Name:</strong> <span class="text-gray-700">{{ $plant['name'] }}</span></p>
        <p><strong class="font-semibold">Scientific Name:</strong> <span class="text-gray-700">{{ $plant->scientific_name }}</span></p>
        <p><strong class="font-semibold">Category:</strong> <span class="text-gray-700">{{ $plant->category->name ?? 'No category' }}</span></p>
        <p><strong class="font-semibold">Location:</strong> <span class="text-gray-700">{{ $plant->location->location_name ?? 'No location' }}</span></p>
        <p><strong class="font-semibold">Description:</strong> <span class="text-gray-700">{{ $plant->description }}</span></p>
        <p><strong class="font-semibold">Habitat:</strong> <span class="text-gray-700">{{ $plant->habitat }}</span></p>
        <p><strong class="font-semibold">Image:</strong>
                        @if($plant->image)
                            <img src="{{ asset($plant->image) }}" alt="{{ $plant->name }}" class="h-24 w-24 object-cover rounded-md">
                        @else
                            <span class="text-gray-500">No Image</span>
                        @endif
        </p>
        <a href="{{ route('plants.index') }}" class="inline-block mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to List</a>
    </div>
</div>
@endsection
