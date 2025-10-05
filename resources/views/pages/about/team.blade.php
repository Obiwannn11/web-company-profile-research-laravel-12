{{-- 1. Menggunakan layout utama --}}
@extends('layouts.app')

{{-- 2. Mengatur judul halaman --}}
@section('title', 'Tim Kami - ReadyLab')

{{-- 3. Mengisi konten halaman --}}
@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        
        {{-- Judul Section --}}
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Kenali Tim Profesional Kami</h1>
            <p class="mt-4 text-lg text-gray-600">Tim ahli kami yang berdedikasi untuk memberikan hasil riset terbaik.</p>
        </div>

        {{-- 4. Grid untuk menampung kartu tim --}}
        {{-- Data '$teamMembers' berasal dari AboutController method 'team()' --}}
        @if($teamMembers->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                {{-- 5. Looping data dan memanggil komponen --}}
                @foreach ($teamMembers as $member)
                    {{-- Memanggil komponen 'team-card' dan mengirim data '$member' --}}
                    <x-team-card :member="$member" />
                @endforeach

            </div>
        @else
            <p class="text-center text-gray-500">Data tim belum tersedia.</p>
        @endif

    </div>
</div>
@endsection