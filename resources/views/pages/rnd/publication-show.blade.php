@extends('layouts.app')

{{-- Gunakan accessor untuk judul --}}
@section('title', $publication->current_translation->title . ' - ReadyLab')

@section('content')
    {{-- Hero Section --}}
    <div class="relative h-72 md:h-96 bg-gray-900">
        {{-- ... (Struktur mirip detail service, gunakan $publication->hero_image) ... --}}
        <h1 class="text-3xl ...">{{ $publication->current_translation->title }}</h1>
        <p class="text-lg text-gray-300 mt-2">{{ $publication->current_category_translation->name }}</p>
    </div>

    {{-- Konten Utama --}}
    <div class="bg-white py-12">
        <div class="container mx-auto px-6 max-w-4xl">
            <article class="prose lg:prose-xl max-w-none">
                {!! $publication->current_translation->content !!} {{-- Gunakan {!! !!} --}}
            </article>
        </div>
    </div>
@endsection