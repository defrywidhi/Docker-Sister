@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Location Details</h1>
    <div>
        <p><strong>Name:</strong> {{ $location->location_name }}</p>
        <p><strong>Latitude:</strong> {{ $location->latitude }}</p>
        <p><strong>Longitude:</strong> {{ $location->longitude }}</p>
        <a href="{{ route('locations.index') }}" class="btn btn-primary">Back to List</a>
    </div>
</div>
@endsection
