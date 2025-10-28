@extends('layouts.app')

@section('title', 'Publikasi - ReadyLab')

@section('content')
    <div class="container mx-auto px-6 py-12">
        {{-- Judul Halaman --}}
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Publikasi Kami</h1>
            <p class="mt-4 text-lg text-gray-600">Artikel riset, jurnal, dan buku yang telah kami publikasikan.</p>
        </div>

        {{-- Filter Pills Kategori --}}
        @if ($categories->isNotEmpty())
            <div class="flex justify-center items-center gap-2 md:gap-4 mb-10 flex-wrap">
                {{-- Tombol "Semua" --}}
                <a href="{{ route('locale.rnd.publications', ['locale' => app()->getLocale()]) }}"
                    class="px-4 py-2 text-sm font-semibold rounded-full transition-colors duration-200
                          {{ !request('category') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    Semua
                </a>

                {{-- Loop untuk setiap kategori dari controller --}}
                @foreach ($categories as $category)
                    {{-- Ambil terjemahan nama kategori --}}
                    @php($categoryNameTranslation = $category->translations->firstWhere('locale', app()->getLocale()))
                    <a href="{{ route('locale.rnd.publications', ['locale' => app()->getLocale(), 'category' => $category->slug]) }}"
                        class="px-4 py-2 text-sm font-semibold rounded-full transition-colors duration-200
                              {{ request('category') == $category->slug ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        {{-- Tampilkan nama kategori, fallback ke slug jika tidak ada --}}
                        {{ $categoryNameTranslation->name ?? $category->slug }}
                    </a>
                @endforeach
            </div>
        @endif

        {{-- Grid untuk Hasil Publikasi --}}
        @if ($publications->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Loop untuk setiap publikasi --}}
                @foreach ($publications as $publication)
                    <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                        {{-- Bagian gambar --}}
                        @if ($publication->hero_image)
                            <img src="{{ asset('storage/' . $publication->hero_image) }}"
                                alt="{{ $publication->current_translation->title }}" class="w-full h-48 object-cover">
                        @endif

                        {{-- Bagian konten --}}
                        <div class="p-6">
                            <p class="text-sm text-blue-500 font-semibold">
                                {{ $publication->current_category_translation->name }}
                            </p>
                            <h3 class="mt-2 text-xl font-bold text-gray-900">
                                {{ $publication->current_translation->title }}
                            </h3>
                            <p class="mt-3 text-gray-600 line-clamp-3">
                                {{ strip_tags($publication->current_translation->content) }}
                            </p>
                            {{-- {{ dd($publication->slug) migrate dulu tabel baru }} --}}
                            {{-- <a href="{{ route('locale.rnd.publication.show', ['locale' => app()->getLocale(), 'slug' => $publication->slug]) }}"
                                class="mt-4 inline-block text-blue-600 font-semibold">
                                Baca Selengkapnya &rarr;
                            </a> --}}
                            <a href="#"
                                class="mt-4 inline-block text-blue-600 font-semibold">
                                Baca Selengkapnya &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500 mt-10">Tidak ada publikasi yang ditemukan untuk kategori ini.</p>
        @endif

    </div>
@endsection
