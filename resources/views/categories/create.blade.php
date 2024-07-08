<!DOCTYPE html>
<html>
<head>
    <title>Create Plant Category</title>
    <!-- Tambahkan link ke Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 py-6">
    <div class="max-w-2xl mx-auto bg-white p-8 shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-6 text-center">Create Plant Category</h1>
        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-bold text-gray-700">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-sm font-bold text-gray-700">Description:</label>
                <textarea id="description" name="description"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:border-blue-500">{{ old('description') }}</textarea>
            </div>
            
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Create
            </button>
        </form>
    </div>
</body>
</html>
