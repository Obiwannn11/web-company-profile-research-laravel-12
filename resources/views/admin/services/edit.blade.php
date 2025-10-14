@extends('admin.layouts.app')

@section('title', 'Edit Layanan')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Layanan: {{ $service->translations->firstWhere('locale', 'id')->title ?? '' }}</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- PENTING: Method untuk update --}}

            {{-- BAGIAN DATA UTAMA (NON-TRANSLATABLE) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug (URL)</label>
                    <input type="text" name="slug" id="slug" value="{{ $service->slug }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div>
                    <label for="hero_image" class="block text-sm font-medium text-gray-700">Ganti Hero Image (Opsional)</label>
                    <input type="file" name="hero_image" id="hero_image"
                           class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                    <div class="mt-2">
                        <span class="text-xs text-gray-500">Gambar Saat Ini:</span>
                        <img src="{{ asset('storage/' . $service->hero_image) }}" alt="Hero Image" class="mt-1 h-16 w-auto rounded">
                    </div>
                </div>
            </div>

            <hr class="my-6">

            {{-- BAGIAN DATA TRANSLASI (DENGAN TABS) --}}
            <div x-data="{ activeTab: 'id' }">
                {{-- Tombol Tabs --}}
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button type="button" @click="activeTab = 'id'"
                                :class="activeTab === 'id' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Bahasa Indonesia (ID)
                        </button>
                        <button type="button" @click="activeTab = 'en'"
                                :class="activeTab === 'en' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            English (EN)
                        </button>
                    </nav>
                </div>

                {{-- Konten Tab Bahasa Indonesia --}}
                <div x-show="activeTab === 'id'" class="mt-6 space-y-6">
                    @php($translation_id = $service->translations->firstWhere('locale', 'id'))
                    <div>
                        <label for="title_id" class="block text-sm font-medium text-gray-700">Judul (ID)</label>
                        <input type="text" name="translations[id][title]" value="{{ $translation_id->title ?? '' }}" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="description_id" class="block text-sm font-medium text-gray-700">Deskripsi Singkat (ID)</label>
                        <textarea name="translations[id][description]" rows="3" required
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_id->description ?? '' }}</textarea>
                    </div>
                    <div>
                        <label for="content_id" class="block text-sm font-medium text-gray-700">Konten Utama (ID)</label>
                        <textarea name="translations[id][content]" rows="10" required
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_id->content ?? '' }}</textarea>
                    </div>
                </div>

                {{-- Konten Tab English --}}
                <div x-show="activeTab === 'en'" class="mt-6 space-y-6">
                    @php($translation_en = $service->translations->firstWhere('locale', 'en'))
                    <div>
                        <label for="title_en" class="block text-sm font-medium text-gray-700">Title (EN)</label>
                        <input type="text" name="translations[en][title]" value="{{ $translation_en->title ?? '' }}" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="description_en" class="block text-sm font-medium text-gray-700">Short Description (EN)</label>
                        <textarea name="translations[en][description]" rows="3" required
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_en->description ?? '' }}</textarea>
                    </div>
                    <div>
                        <label for="content_en" class="block text-sm font-medium text-gray-700">Main Content (EN)</label>
                        <textarea name="translations[en][content]" rows="10" required
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_en->content ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="mt-8 border-t pt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Update Layanan
                </button>
                <a href="{{ route('admin.services.index') }}" class="ml-4 text-gray-600 hover:text-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection