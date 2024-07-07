@extends('layouts.app')

@section('content')
    <section>
        <div class="text-center font-bold m-4 p-4">
            <h1 class="text-6xl">Welcome to Simbarka</h1>
            <p class="text-gray-500 font-normal font-xl mt-4 pt-4">Web for simbar information and shopping</p>
            <p class="text-gray-500 font-normal font-xl">This web for demo the web service</p>
        </div>

        <div class="flex flex-col justify-center items-center">
            <h1 class="text-center mb-4">This is Link for do the CRUD for the tables</h1>
            <a href="/categories" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 text-center">Category</a>
            <a href="/locations" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 text-center">Location</a>
            <a href="plants" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2 text-center">Plants</a>
        </div>
        
    </section>
@endsection
