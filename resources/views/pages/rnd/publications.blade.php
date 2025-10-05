@extends('layouts.app')

@section('title', 'Publikasi - ReadyLab')

@section('content')
<div class="container mx-auto px-6 py-12">
    {{-- 1. Judul Halaman --}}
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Publikasi Kami</h1>
        <p class="mt-4 text-lg text-gray-600">Artikel riset, jurnal, dan buku yang telah kami publikasikan.</p>
    </div>

    {{-- 2. Filter Pills Kategori --}}
    @if($categories->isNotEmpty())
    <div class="flex justify-center items-center gap-2 md:gap-4 mb-10 flex-wrap">
        {{-- Tombol "Semua" --}}
        <a href="{{ route('locale.rnd.publication', ['locale' => app()->getLocale()]) }}"
           class="px-4 py-2 text-sm font-semibold rounded-full transition-colors duration-200
                  {{ !request('category') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            Semua
        </a>

        {{-- Loop untuk setiap kategori dari controller --}}
        @foreach ($categories as $category)
            @php($translation = $category->translations->firstWhere('locale', app()->getLocale()))
            <a href="{{ route('locale.rnd.publication', ['locale' => app()->getLocale(), 'category' => $category->slug]) }}"
               class="px-4 py-2 text-sm font-semibold rounded-full transition-colors duration-200
                      {{ request('category') == $category->slug ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                {{ $translation->name ?? '' }}
            </a>
        @endforeach
    </div>
    @endif

    {{-- 3. Grid untuk Hasil Publikasi --}}
    @if($publications->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($publications as $publication)
                @php
                    $translation = $publication->translations->firstWhere('locale', app()->getLocale());
                    $categoryTranslation = $publication->category->translations->firstWhere('locale', app()->getLocale());
                @endphp
                <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                    @if($publication->hero_image)
                        <img src="{{ asset('storage/' . $publication->hero_image) }}" alt="{{ $translation->title ?? '' }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-6">
                        <p class="text-sm text-blue-500 font-semibold">{{ $categoryTranslation->name ?? '' }}</p>
                        <h3 class="mt-2 text-xl font-bold text-gray-900">{{ $translation->title ?? 'Judul tidak tersedia' }}</h3>
                        <p class="mt-3 text-gray-600 line-clamp-3">
                            {{-- Strip tags untuk mengambil teks bersih sebagai ringkasan --}}
                            {{ strip_tags($translation->content ?? '') }}
                        </p>
                        {{-- Anda bisa menambahkan link detail jika diperlukan --}}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-500 mt-10">Tidak ada publikasi yang ditemukan untuk kategori ini.</p>
    @endif

</div>
@endsection