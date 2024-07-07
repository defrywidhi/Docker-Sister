@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Category Details</h1>
    <div>
        <p><strong>Name:</strong> {{ $category->name }}</p>
        <p><strong>Description:</strong> {{ $category->description }}</p>
        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back to List</a>
    </div>
</div>
@endsection
