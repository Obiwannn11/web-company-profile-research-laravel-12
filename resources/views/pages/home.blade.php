@extends('layouts.app')

@section('title', 'Selamat Datang di ReadyLab')

@section('content')

{{-- 1. Hero Section --}}
<div class="relative bg-gray-800 text-white py-20 md:py-32">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-4xl md:text-6xl font-bold leading-tight"> {{ $heroContent->get('hero_title', 'Judul Hero') }} </h1>
        <p class="mt-4 text-lg md:text-xl text-gray-300 max-w-3xl mx-auto"> {{ $heroContent->get('hero_subtitle', 'Subjudul Hero') }} </p>
        <a href="{{ route('locale.contact.index', ['locale' => app()->getLocale()]) }}" 
           class="mt-8 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full transition-colors duration-300">
            {{ $heroContent->get('hero_button_text', 'Hubungi Kami') }}
        </a>
    </div>
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