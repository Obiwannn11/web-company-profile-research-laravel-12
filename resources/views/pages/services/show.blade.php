@extends('layouts.app')

{{-- Mengambil judul dari data terjemahan untuk service ini --}}
@php
    $translation = $service->translations->firstWhere('locale', app()->getLocale());
@endphp

@section('title', ($translation->title ?? 'Layanan') . ' - ReadyLab')

@section('content')

{{-- 1. Hero Section dengan Gambar Latar --}}
<div class="relative h-72 md:h-96 bg-gray-900">
    <div class="absolute inset-0">
        <img src="{{ asset('storage/' . $service->hero_image) }}" alt="{{ $translation->title ?? '' }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black opacity-50"></div>
    </div>
    <div class="relative container mx-auto px-6 flex items-center h-full">
        <div>
            <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight">{{ $translation->title ?? 'Judul tidak tersedia' }}</h1>
        </div>
    </div>
</div>

{{-- 2. Konten Utama Layanan --}}
<div class="bg-white py-12">
    <div class="container mx-auto px-6 max-w-4xl">
        {{-- 'prose' adalah class dari Tailwind Typography untuk styling teks --}}
        <article class="prose lg:prose-xl max-w-none">
            {{-- Deskripsi singkat (jika ada) --}}
            <p class="lead">{{ $translation->description ?? '' }}</p>

            {{-- Konten utama yang bisa berisi HTML --}}
            {{-- Menggunakan {!! !!} agar tag HTML seperti <img> atau <b> dirender --}}
            {!! $translation->content ?? 'Konten detail belum tersedia.' !!}
        </article>
    </div>
</div>

@endsection