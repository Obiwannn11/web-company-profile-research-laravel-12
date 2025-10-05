@props(['member'])

{{-- x-data mendefinisikan state untuk Alpine.js --}}
<div x-data="{ open: false }" class="border border-transparent rounded-lg p-6 transition-all duration-300 hover:border-blue-200 hover:shadow-lg">
    {{-- Mengambil data terjemahan untuk locale yang aktif --}}
    @php
        $translation = $member->translations->firstWhere('locale', app()->getLocale());
    @endphp

    <img class="h-24 w-24 rounded-full mx-auto" src="{{ asset('storage/' . $member->photo) }}" alt="{{ $translation->name ?? '' }}">
    
    <div class="text-center mt-4">
        <h3 class="text-xl font-semibold text-gray-900">{{ $translation->name ?? 'Nama tidak tersedia' }}</h3>
        <p class="text-blue-600 font-medium">{{ $translation->position ?? '' }}</p>
        <p class="text-gray-500 text-sm mt-1">{{ $translation->expertise ?? '' }}</p>
    </div>

    <div class="text-center mt-4">
        {{-- Tombol ini akan mengubah state 'open' saat diklik --}}
        <button @click="open = !open" class="text-sm text-blue-700 font-semibold focus:outline-none">
            <span x-show="!open">Lihat Detail</span>
            <span x-show="open">Sembunyikan Detail</span>
        </button>
    </div>

    {{-- Konten ini hanya akan tampil jika state 'open' adalah true --}}
    <div x-show="open" x-transition class="mt-4 border-t pt-4">
        <p class="text-gray-600 text-sm">
            {!! nl2br(e($translation->details ?? '')) !!}
        </p>
    </div>
</div>