@extends('layouts.app')

@section('title', 'Layanan Kami - ReadyLab')

@section('content')
<div class="bg-gray-50">
    <div class="container mx-auto px-6 py-12">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Solusi Layanan Kami</h1>
            <p class="mt-4 text-lg text-gray-600">Kami menyediakan berbagai layanan riset dan pengembangan untuk kebutuhan Anda.</p>
        </div>

        @if($services->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($services as $service)
                    @php($translation = $service->translations->firstWhere('locale', app()->getLocale()))
                    <a href="{{ route('locale.services.show', ['locale' => app()->getLocale(), 'slug' => $service->slug]) }}" 
                       class="block border rounded-lg overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
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
        @else
            <p class="text-center text-gray-500">Layanan belum tersedia saat ini.</p>
        @endif
    </div>
</div>
@endsection