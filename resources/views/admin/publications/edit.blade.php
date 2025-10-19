@extends('admin.layouts.app')

@section('title', 'Edit Publikasi')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Publikasi</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.publications.update', $publication) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- BAGIAN DATA UTAMA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="publication_category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="publication_category_id" id="publication_category_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $publication->publication_category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->translations->firstWhere('locale', 'id')->name ?? $category->slug }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="hero_image" class="block text-sm font-medium text-gray-700">Ganti Hero Image (Opsional)</label>
                    <input type="file" name="hero_image" id="hero_image"
                           class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                    <div class="mt-2">
                        <span class="text-xs text-gray-500">Gambar Saat Ini:</span>
                        <img src="{{ asset('storage/' . $publication->hero_image) }}" alt="Current Image" class="mt-1 h-16 w-auto rounded">
                    </div>
                </div>
            </div>

            <hr class="my-6">

            {{-- BAGIAN DATA TRANSLASI (TABS) --}}
            <div x-data="{ activeTab: 'id' }">
                {{-- Tombol Tabs --}}
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <button type="button" @click="activeTab = 'id'" :class="activeTab === 'id' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Bahasa Indonesia (ID)
                        </button>
                        <button type="button" @click="activeTab = 'en'" :class="activeTab === 'en' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            English (EN)
                        </button>
                    </nav>
                </div>

                {{-- Konten Tab Bahasa Indonesia --}}
                <div x-show="activeTab === 'id'" class="mt-6 space-y-6">
                    @php($translation_id = $publication->translations->firstWhere('locale', 'id'))
                    <div>
                        <label for="title_id" class="block text-sm font-medium text-gray-700">Judul (ID)</label>
                        <input type="text" name="translations[id][title]" id="title_id" value="{{ $translation_id->title ?? '' }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="content_id" class="block text-sm font-medium text-gray-700">Konten (ID)</label>
                        <textarea name="translations[id][content]" id="content_id" rows="10" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_id->content ?? '' }}</textarea>
                    </div>
                </div>

                {{-- Konten Tab English --}}
                <div x-show="activeTab === 'en'" class="mt-6 space-y-6">
                    @php($translation_en = $publication->translations->firstWhere('locale', 'en'))
                    <div>
                        <label for="title_en" class="block text-sm font-medium text-gray-700">Title (EN)</label>
                        <input type="text" name="translations[en][title]" id="title_en" value="{{ $translation_en->title ?? '' }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="content_en" class="block text-sm font-medium text-gray-700">Content (EN)</label>
                        <textarea name="translations[en][content]" id="content_en" rows="10" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_en->content ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="mt-8 border-t pt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update</button>
                <a href="{{ route('admin.publications.index') }}" class="ml-4 text-gray-600 hover:text-gray-800">Batal</a>
            </div>
        </form>
    </div>
@endsection