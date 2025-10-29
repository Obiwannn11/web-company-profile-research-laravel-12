@extends('layouts.app')

@section('title', ''. $pageContent->get('faq_title_web', 'Pertanyaan yang Sering Diajukan') . ' - ReadyLab')

@section('content')
<div class="py-12">
    <div class="container mx-auto px-6 max-w-4xl">
        
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $pageContent->get('faq_title', 'Kenali Tim Profesional Kamiiii') }}</h1>
            <p class="mt-4 text-lg text-gray-600">{{ $pageContent->get('faq_subtitle', 'Temukan jawaban cepat untuk pertanyaan umummmumm tentang layanan kami.') }}</p>
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