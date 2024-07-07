@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Plant Details</h1>
    <div>
        <p><strong>Name:</strong> {{ $plant->name }}</p>
        <p><strong>Scientific Name:</strong> {{ $plant->scientific_name }}</p>
        <p><strong>Category:</strong> {{ $plant->category->name }}</p>
        <p><strong>Location:</strong> {{ $plant->location->location_name }}</p>
        <p><strong>Description:</strong> {{ $plant->description }}</p>
        <p><strong>Habitat:</strong> {{ $plant->habitat }}</p>
        <p><strong>Image:</strong> 
            @if($plant->image)
                <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->name }}" style="max-width: 200px;">
            @else
                No image
            @endif
        </p>
        <a href="{{ route('plants.index') }}" class="btn btn-primary">Back to List</a>
    </div>
</div>
@endsection
