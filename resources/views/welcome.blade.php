@extends('layouts.app')

@section('content')
    <section>
        <div class="text-center font-bold mt-6 p-4">
            <h1 class="text-6xl">Welcome to <span class="text-green-500">Simbarka</span></h1>
            <p class="text-gray-500 font-normal font-xl mt-4 pt-4">Web for simbar information and shopping</p>
            <p class="text-gray-500 font-normal font-xl">This web for demo the web service</p>
        </div>

        <div class="flex flex-col justify-center items-center">
            <h1 class="text-center mb-4">This is Link for do the <strong>CRUD</strong> for the tables</h1>
            <div class="grid grid-cols-3">
                <a href="/categories" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-2 text-center m-4">Category</a>
                <a href="/locations" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-2 text-center m-4">Location</a>
                <a href="plants" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-2 text-center m-4">Plants</a>
            </div>
        </div>
        
    </section>
@endsection
