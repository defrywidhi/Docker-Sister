@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    {{-- Alert Start --}}
    @if(session('success'))
     <div id="alert-success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
         <strong class="font-bold">Success!</strong>
         <span class="block sm:inline">{{ session('success') }}</span>
         <span id="close-success" class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer">
             <svg class="fill-current h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                 <title>Close</title>
                 <path d="M14.348 5.652a.5.5 0 0 1 0 .707L10.707 10l3.64 3.641a.5.5 0 0 1-.707.707L10 10.707l-3.641 3.64a.5.5 0 0 1-.707-.707L9.293 10 5.652 6.359a.5.5 0 0 1 .707-.707L10 9.293l3.641-3.64a.5.5 0 0 1 .707 0z"/>
             </svg>
         </span>
     </div>
    @endif
    <!-- Perbesar dan pusatkan judul -->
    <h1 class="text-4xl font-bold text-center mb-8">Plants</h1>
    
    <!-- Tombol untuk menambahkan plant baru -->
    @auth
    <a href="{{ route('plants.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Add New Plant</a>
    @endauth
    
    <!-- Tabel dengan styling Tailwind CSS -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <!-- Styling untuk header tabel -->
                    <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-200 text-left text-sm leading-4 font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-200 text-left text-sm leading-4 font-semibold text-gray-700 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-200 text-left text-sm leading-4 font-semibold text-gray-700 uppercase tracking-wider">Scientific Name</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-200 text-left text-sm leading-4 font-semibold text-gray-700 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-200 text-left text-sm leading-4 font-semibold text-gray-700 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-200 text-left text-sm leading-4 font-semibold text-gray-700 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-200 text-left text-sm leading-4 font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plants as $plant)
                <tr class="bg-white border-b">
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700">{{ $plant->id }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700">{{ $plant->name }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700">{{ $plant->scientific_name }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700">{{ $plant->category->name ?? 'No category' }}</td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700">{{ $plant->location->location_name ?? 'No location' }}</td>
                    {{-- <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700">
                        <img src="{{ asset($plant->image) }}" alt="image" class="h-24 w-24 object-cover">
                    </td> --}}
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700">
                        @if($plant->image)
                            <img src="{{ asset($plant->image) }}" alt="{{ $plant->name }}" class="h-24 w-24 object-cover rounded-md">
                        @else
                            <span class="text-gray-500">No Image</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-700">
                        @auth
                        <a href="{{ route('plants.show', $plant->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded inline-block mr-2">View</a>
                        <a href="{{ route('plants.edit', $plant->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded inline-block mr-2">Edit</a>
                        <form action="{{ route('plants.destroy', $plant->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Delete</button>
                        </form>
                        @else
                        <a href="{{ route('login.form') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded inline-block mr-2">Login to View</a>
                        @endauth
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Ambil elemen-elemen yang diperlukan
    const successAlert = document.getElementById('alert-success');
    const errorAlert = document.getElementById('alert-error');

    // Tambahkan event listener untuk menutup alert saat tombol X diklik
    document.getElementById('close-success').addEventListener('click', function() {
        successAlert.style.display = 'none';
    });

    document.getElementById('close-error').addEventListener('click', function() {
        errorAlert.style.display = 'none';
    });
</script>
@endsection
