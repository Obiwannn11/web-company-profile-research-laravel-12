@extends('layouts.app')

@section('title', 'FAQ - ReadyLab')

@section('content')
<div class="py-12">
    <div class="container mx-auto px-6 max-w-4xl">
        
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Pertanyaan yang Sering Diajukan</h1>
            <p class="mt-4 text-lg text-gray-600">Temukan jawaban cepat untuk pertanyaan umum tentang layanan kami.</p>
        </div>

        {{-- Container untuk daftar accordion FAQ --}}
        {{-- Data '$faqs' berasal dari AboutController method 'faq()' --}}
        @if($faqs->isNotEmpty())
            <div class="space-y-4">
                @foreach ($faqs as $faq)
                    <x-faq-accordion :faq="$faq" />
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">Belum ada pertanyaan yang tersedia.</p>
        @endif

    </div>
</div>
@endsection