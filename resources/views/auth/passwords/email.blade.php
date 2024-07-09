@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900">
        <div class="w-full max-w-md px-6 py-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Reset Password</h2>
            @if (session('status'))
                <div class="mt-4 text-sm text-green-500">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mt-4">
                    <ul class="list-disc list-inside text-sm text-red-500">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="mt-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" class="block w-full mt-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-500 rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Send Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
