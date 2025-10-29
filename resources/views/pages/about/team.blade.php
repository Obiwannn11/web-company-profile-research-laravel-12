{{-- 1. Menggunakan layout utama --}}
@extends('layouts.app')

{{-- 2. Mengatur judul halaman --}}
@section('title', ''. $pageContent->get('team_title_web', 'Kenali Tim Profesional Kamiiiiii') . ' - ReadyLab')

{{-- 3. Mengisi konten halaman --}}
@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        
        {{-- Judul Section --}}
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $pageContent->get('team_title', 'Kenali Tim Profesional Kamiiiiii') }}</h1>
            <p class="mt-4 text-lg text-gray-600">{{ $pageContent->get('team_subtitle', 'Tim ahli kami yang berdedikasi untuk memberikan hasil riset terbaikikikk.') }}</p>
        </div>

        {{-- 4. Grid untuk menampung kartu tim --}}
        @if($teamMembers->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                @foreach ($teamMembers as $member)
                    <x-team-card :member="$member" />
                @endforeach

            </div>
        @else
            <p class="text-center text-gray-500">Data tim belum tersedia.</p>
        @endif

    </div>
</div>
@endsection