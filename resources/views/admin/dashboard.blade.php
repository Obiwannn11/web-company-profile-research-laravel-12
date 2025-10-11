@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800">Selamat Datang, {{ Auth::user()->name }}!</h1>
    <p class="mt-2 text-gray-600">Ini adalah halaman dashboard admin Anda.</p>
@endsection