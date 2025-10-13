@extends('admin.layouts.guest')

@section('content')
<div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-center text-gray-900">Admin Login</h1>

    {{-- Menampilkan error jika login gagal --}}
    @if ($errors->any())
        <div class="text-red-500 text-sm">
            {{ $errors->first('email') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        
        {{-- Input Email --}}
        <div>
            <label for="email" class="text-sm font-medium text-gray-700">Email Address</label>
            <input id="email" name="email" type="email" required autofocus
                   class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        {{-- Input Password --}}
        <div>
            <label for="password" class="text-sm font-medium text-gray-700">Password</label>
            <input id="password" name="password" type="password" required
                   class="w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <button type="submit" 
                    class="w-full px-4 py-2 text-lg font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Login
            </button>
        </div>
    </form>
</div>
@endsection