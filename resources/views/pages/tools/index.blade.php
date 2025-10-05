@extends('layouts.app')

@section('title', 'Tools Kami - ReadyLab')

@section('content')
<div class="bg-white py-12">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Peralatan & Teknologi</h1>
            <p class="mt-4 text-lg text-gray-600">Teknologi dan software yang kami gunakan untuk mendukung riset dan analisis.</p>
        </div>

        @if($tools->isNotEmpty())
            {{-- Kita gunakan 'space-y-8' untuk memberi jarak antar kartu --}}
            <div class="space-y-8 max-w-4xl mx-auto">
                @foreach ($tools as $tool)
                    @php($translation = $tool->translations->firstWhere('locale', app()->getLocale()))
                    <div class="border rounded-lg shadow-sm flex flex-col md:flex-row overflow-hidden">
                        {{-- Kolom Kiri: Logo --}}
                        <div class="flex-shrink-0 w-full md:w-48 bg-gray-50 flex items-center justify-center p-6">
                            <img src="{{ asset('storage/' . $tool->logo_image) }}" alt="Logo {{ $translation->title ?? '' }}" class="h-24 w-auto object-contain">
                        </div>
                        
                        {{-- Kolom Kanan: Detail --}}
                        <div class="p-6 flex-grow">
                            <h3 class="text-xl font-bold text-gray-900">{{ $translation->title ?? 'Judul tidak tersedia' }}</h3>
                            <p class="mt-2 text-gray-600">{{ $translation->description ?? '' }}</p>
                            
                            {{-- Daftar Poin (dari kolom JSON) --}}
                            @if(!empty($translation->points))
                                <ul class="mt-4 space-y-2 text-sm text-gray-700 list-disc list-inside">
                                    @foreach ($translation->points as $point)
                                        <li>{{ $point }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            {{-- Link Video (jika ada) --}}
                            @if($tool->video_url)
                                <div class="mt-4">
                                    <a href="{{ $tool->video_url }}" target="_blank" rel="noopener noreferrer" 
                                       class="inline-flex items-center text-blue-600 font-semibold hover:underline">
                                        Lihat Pengenalan
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">Informasi tools belum tersedia.</p>
        @endif
    </div>
</div>
@endsection