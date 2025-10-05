@extends('layouts.app')

@section('title', 'Tentang Kami - ReadyLab')

@section('content')
<div class="bg-white py-12">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
                {{-- Mengambil data dari variabel $companySettings --}}
                {{ $companySettings->get('company.name', 'ReadyLab') }}
            </h1>
            <p class="mt-4 text-lg text-gray-600">
                {{ $companySettings->get('company.focus', 'Fokus perusahaan tidak tersedia.') }}
            </p>
        </div>

        <article class="prose lg:prose-xl max-w-none">
            <h2>Sejarah Kami</h2>
            <p>
                {{ $companySettings->get('company.history', 'Sejarah perusahaan belum tersedia.') }}
            </p>
            
            {{-- Anda bisa menambahkan section lain seperti Visi & Misi di sini --}}
            {{-- dengan mengambil key yang sesuai, cth: 'company.vision' --}}
        </article>
    </div>
</div>
@endsection