@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 p-6 bg-white rounded-lg shadow-md max-w-2xl">
    <h1 class="text-3xl font-bold mb-6 text-center">Category Details</h1>
    <div class="space-y-4">
        <p><strong class="font-semibold">Name:</strong> <span class="text-gray-700">{{ $category->name }}</span></p>
        <p><strong class="font-semibold">Description:</strong> <span class="text-gray-700">{{ $category->description }}</span></p>
        <a href="{{ route('categories.index') }}" class="inline-block mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to List</a>
    </div>
</div>
@endsection