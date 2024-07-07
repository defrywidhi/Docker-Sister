<!DOCTYPE html>
<html>
<head>
    <title>Create Plant Category</title>
</head>
<body>
    <h1>Create Plant Category</h1>
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description">{{ old('description') }}</textarea>
        
        <button type="submit">Create</button>
    </form>
</body>
</html>
