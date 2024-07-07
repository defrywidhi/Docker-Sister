@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Plants</h1>
    <a href="{{ route('plants.create') }}" class="btn btn-primary">Add New Plant</a>
    <table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Scientific Name</th>
        <th>Category</th>
        <th>Location</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
            </thead>
            <tbody>
                @foreach ($plants as $plant)
                <tr>
                    <td>{{ $plant->id }}</td>
                    <td>{{ $plant->name }}</td>
                    <td>{{ $plant->scientific_name }}</td>
                    <td>{{ $plant->category->name ?? 'No category' }}</td>
                    <td>{{ $plant->location->location_name ?? 'No location' }}</td>
                    <td>
                        @if($plant->image)
                            <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->name }}" width="100">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('plants.show', $plant->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('plants.edit', $plant->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('plants.destroy', $plant->id) }}" method="POST" style="display:inline;">
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
