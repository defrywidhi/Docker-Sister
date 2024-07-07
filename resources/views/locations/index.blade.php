@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Locations</h1>
    <a href="{{ route('locations.create') }}" class="btn btn-primary">Add New Location</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locations as $location)
            <tr>
                <td>{{ $location->id }}</td>
                <td>{{ $location->location_name }}</td>
                <td>{{ $location->latitude }}</td>
                <td>{{ $location->longitude }}</td>
                <td>
                    <a href="{{ route('locations.show', $location->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('locations.destroy', $location->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
