@extends('layouts.app')

@section('title', 'Selamat Datang di ReadyLab')

@section('content')


{{-- 1. Hero Carousel Section --}}
<div class="relative w-full h-96 md:h-[500px] lg:h-[600px] swiper-hero">
    <div class="swiper-wrapper">
        @foreach ($carousels as $slide)
            <div class="swiper-slide relative">
                {{-- Gambar Latar --}}
                <img src="{{ asset('storage/' . $slide->image) }}" alt="{{ $slide->current_translation->title }}" class="w-full h-full object-cover">
                {{-- Overlay Gelap --}}
                <div class="absolute inset-0 bg-black opacity-70"></div>
                {{-- Konten Teks --}}
                <div class="absolute inset-0 flex items-center justify-center text-center text-white p-6">
                    <div class="max-w-2xl">
                        {{-- Gunakan accessor 'current_translation' --}}
                        @if($slide->current_translation->title)
                            <h1 class="text-3xl md:text-5xl font-bold leading-tight">{{ $slide->current_translation->title }}</h1>
                        @endif
                        @if($slide->current_translation->subtitle)
                            <p class="mt-4 text-lg md:text-xl text-gray-200">{{ $slide->current_translation->subtitle }}</p>
                        @endif
                        
                        {{-- Gunakan accessor 'final_url' --}}
                        @if($slide->current_translation->button_text && $slide->final_url != '#')
                            <a href="{{ $slide->final_url }}" 
                               class="mt-8 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full transition-colors duration-300">
                                {{ $slide->current_translation->button_text }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- Tombol Navigasi (Opsional) --}}
    <div class="swiper-button-prev text-white"></div>
    <div class="swiper-button-next text-white"></div>
    {{-- Paginasi (Opsional) --}}
    <div class="swiper-pagination"></div>
</div>

{{-- 2. Featured Services Section --}}
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">{{  $heroContent->get('home_services_title', 'Layanan Kami Hehe') }}</h2>
            <p class="mt-3 text-lg text-gray-600"> {{ $heroContent->get('home_services_subtitle', 'Ini subtitle layanan') }}</p>
        </div>

        @if($featuredServices->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Loop data dari PageController --}}
                @foreach ($featuredServices as $service)
                    @php($translation = $service->translations->firstWhere('locale', app()->getLocale()))
                    <a href="{{ route('locale.services.show', ['locale' => app()->getLocale(), 'slug' => $service->slug]) }}" 
                       class="block bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <img src="{{ asset('storage/' . $service->hero_image) }}" alt="{{ $translation->title ?? '' }}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900">{{ $translation->title ?? 'Judul tidak tersedia' }}</h3>
                            <p class="mt-3 text-gray-600 line-clamp-3">{{ $translation->description ?? '' }}</p>
                            <span class="mt-4 inline-block text-blue-600 font-semibold">
                                Pelajari Lebih Lanjut &rarr;
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>

{{-- 3. Call to Action (CTA) Section --}}
<div class="bg-white py-12">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-gray-900">{{ $heroContent->get('cta_title', 'ini CTA Title') }}</h2>
        <p class="mt-3 text-lg text-gray-600 max-w-2xl mx-auto">{{ $heroContent->get('cta_subtitle', 'ini cta sub title') }}</p>
        <a href="{{ route('locale.contact.index', ['locale' => app()->getLocale()]) }}" 
           class="mt-8 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full transition-colors duration-300">
            {{ $heroContent->get('cta_button_text', 'Pencet disini') }}
        </a>
    </div>
</div>

@endsection