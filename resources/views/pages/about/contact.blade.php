@extends('layouts.app')

@section('title', 'Kontak Kami - ReadyLab')

@section('content')
<div class="container mx-auto px-6 py-12">
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Hubungi Kami</h1>
        <p class="mt-4 text-lg text-gray-600">Kami siap membantu menjawab pertanyaan Anda.</p>
    </div>

    {{-- Info Kontak --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center max-w-5xl mx-auto">
        {{-- Alamat --}}
        <div class="p-6 border rounded-lg">
            <h3 class="text-xl font-semibold">Alamat</h3>
            <p class="mt-2 text-gray-600">{{ $contactSettings->get('contact.address', 'Alamat tidak tersedia.') }}</p>
        </div>
        {{-- Telepon --}}
        <div class="p-6 border rounded-lg">
            <h3 class="text-xl font-semibold">Telepon</h3>
            <p class="mt-2 text-gray-600">{{ $contactSettings->get('contact.phone', 'Telepon tidak tersedia.') }}</p>
        </div>
        {{-- Email --}}
        <div class="p-6 border rounded-lg">
            <h3 class="text-xl font-semibold">Email</h3>
            <p class="mt-2 text-gray-600">{{ $contactSettings->get('contact.email', 'Email tidak tersedia.') }}</p>
        </div>
    </div>

    {{-- Peta Lokasi --}}
    <div class="mt-12">
        <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow-lg">
            {{-- Ganti 'src' dengan link embed Google Maps Anda --}}
            <iframe
                src="{{ $contactSettings->get('contact.maps_url', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.766367339795!2d119.44778131530659!3d-5.141334996265737!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee2b336712b33%3A0x671b5695cf6f022!2sPantai%20Losari!5e0!3m2!1sen!2sid!4v1664972980898!5m2!1sen!2sid') }}"
                width="600"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>
@endsection