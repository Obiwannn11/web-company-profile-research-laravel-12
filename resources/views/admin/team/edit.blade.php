@extends('admin.layouts.app')

@section('title', 'Edit Anggota Tim')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Anggota Tim: {{ $team->translations->firstWhere('locale', 'id')->name ?? '' }}</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.team.update', $team) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- BAGIAN DATA UTAMA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700">Ganti Foto Profil (Opsional)</label>
                    <input type="file" name="photo" id="photo" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    <div class="mt-2">
                        <span class="text-xs text-gray-500">Foto Saat Ini:</span>
                        <img src="{{ asset('storage/' . $team->photo) }}" alt="Current Photo" class="mt-1 h-16 w-16 rounded-full object-cover">
                    </div>
                </div>
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700">Nomor Urut</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ $team->sort_order }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <hr class="my-6">

            {{-- BAGIAN DATA TRANSLASI (TABS) --}}
            <div x-data="{ activeTab: 'id' }">
                {{-- Tombol Tabs --}}
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button type="button" @click="activeTab = 'id'" :class="activeTab === 'id' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Bahasa Indonesia (ID)
                        </button>
                        <button type="button" @click="activeTab = 'en'" :class="activeTab === 'en' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            English (EN)
                        </button>
                    </nav>
                </div>

                {{-- Konten Tab Bahasa Indonesia --}}
                <div x-show="activeTab === 'id'" class="mt-6 space-y-6">
                    @php($translation_id = $team->translations->firstWhere('locale', 'id'))
                    <div>
                        <label for="name_id" class="block text-sm font-medium text-gray-700">Nama Lengkap & Gelar (ID)</label>
                        <input type="text" name="translations[id][name]" id="name_id" value="{{ $translation_id->name ?? '' }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="position_id" class="block text-sm font-medium text-gray-700">Posisi Jabatan (ID)</label>
                        <input type="text" name="translations[id][position]" id="position_id" value="{{ $translation_id->position ?? '' }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="expertise_id" class="block text-sm font-medium text-gray-700">Keahlian (ID)</label>
                        <textarea name="translations[id][expertise]" id="expertise_id" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_id->expertise ?? '' }}</textarea>
                    </div>
                    <div>
                        <label for="details_id" class="block text-sm font-medium text-gray-700">Detail (untuk Accordion)</label>
                        <textarea name="translations[id][details]" id="details_id" rows="5" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_id->details ?? '' }}</textarea>
                    </div>
                </div>

                {{-- Konten Tab English --}}
                <div x-show="activeTab === 'en'" class="mt-6 space-y-6">
                    @php($translation_en = $team->translations->firstWhere('locale', 'en'))
                    <div>
                        <label for="name_en" class="block text-sm font-medium text-gray-700">Full Name & Title (EN)</label>
                        <input type="text" name="translations[en][name]" id="name_en" value="{{ $translation_en->name ?? '' }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="position_en" class="block text-sm font-medium text-gray-700">Position (EN)</label>
                        <input type="text" name="translations[en][position]" id="position_en" value="{{ $translation_en->position ?? '' }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="expertise_en" class="block text-sm font-medium text-gray-700">Expertise (EN)</label>
                        <textarea name="translations[en][expertise]" id="expertise_en" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_en->expertise ?? '' }}</textarea>
                    </div>
                    <div>
                        <label for="details_en" class="block text-sm font-medium text-gray-700">Details (for Accordion)</label>
                        <textarea name="translations[en][details]" id="details_en" rows="5" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_en->details ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="mt-8 border-t pt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update</button>
                <a href="{{ route('admin.team.index') }}" class="ml-4 text-gray-600 hover:text-gray-800">Batal</a>
            </div>
        </form>
    </div>
@endsection