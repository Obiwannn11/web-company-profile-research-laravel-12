@extends('layouts.app')

@section('title', 'R&D Projects - ReadyLab')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Proyek Research & Development</h1>
        <p class="mt-4 text-lg text-gray-600">Jelajahi proyek inovatif yang kami kerjakan, baik secara internal maupun untuk klien eksternal.</p>
    </div>

    {{-- Section Eksternal --}}
    @if($externalProjects->isNotEmpty())
        {{-- Inisialisasi Alpine.js: set tab aktif ke proyek pertama --}}
        <div x-data="{ activeTab: '{{ $externalProjects->first()->id }}' }" class="mt-10">
            <h2 class="text-2xl font-semibold mb-4">Proyek Eksternal</h2>
            <div class="flex flex-col md:flex-row gap-8">
                {{-- Kolom Kiri: Nav Pills --}}
                <div class="w-full md:w-1/3">
                    <ul class="space-y-2">
                        @foreach ($externalProjects as $project)
                            @php($translation = $project->translations->firstWhere('locale', app()->getLocale()))
                            <li>
                                <button @click="activeTab = '{{ $project->id }}'" 
                                        :class="activeTab === '{{ $project->id }}' ? 'bg-blue-600 text-white' : 'bg-gray-100 hover:bg-gray-200'"
                                        class="w-full text-left p-4 rounded-md transition-colors duration-200">
                                    {{ $translation->title ?? 'Judul tidak tersedia' }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
                {{-- Kolom Kanan: Konten Detail --}}
                <div class="w-full md:w-2/3">
                    @foreach ($externalProjects as $project)
                        @php($translation = $project->translations->firstWhere('locale', app()->getLocale()))
                        {{-- Konten hanya tampil jika tab-nya aktif --}}
                        <div x-show="activeTab === '{{ $project->id }}'" x-transition>
                            <div class="flex items-start gap-4">
                                <div>
                                    <h3 class="text-xl font-bold">{{ $translation->title ?? '' }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">{{ $translation->details ?? '' }}</p>
                                </div>
                                <img src="{{ asset('storage/' . $project->icon_image) }}" alt="Icon" class="w-16 h-16 object-cover">
                            </div>
                            <div class="mt-4 border-t pt-4 text-gray-600">
                                {!! nl2br(e($translation->description ?? '')) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    
    {{-- Anda bisa menambahkan section untuk Proyek Internal dengan logika yang sama persis di bawah ini --}}

</div>
@endsection