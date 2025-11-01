@extends('admin.layouts.app')

@section('title', 'Edit Slide Carousel')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Slide Carousel</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.carousels.update', $carousel) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- BAGIAN DATA UTAMA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Ganti Gambar Slide (Opsional)</label>
                    <input type="file" name="image" id="image"
                           class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                    <div class="mt-2">
                        <span class="text-xs text-gray-500">Gambar Saat Ini:</span>
                        <img src="{{ asset('storage/' . $carousel->image) }}" alt="Current Image" class="mt-1 h-24 w-auto rounded">
                    </div>
                </div>
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700">Nomor Urut</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ $carousel->sort_order }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="md:col-span-2">
                    <label for="link_url" class="block text-sm font-medium text-gray-700">Link URL (Opsional)</label>
                    <input type="text" name="link_url" id="link_url" value="{{ $carousel->link_url }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                           placeholder="Contoh: /id/services atau https://www.google.com">
                </div>
            </div>

            <hr class="my-6">

            {{-- BAGIAN DATA TRANSLASI (TABS) --}}
            <div x-data="{ activeTab: 'id' }">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button type="button" @click="activeTab = 'id'" :class="activeTab === 'id' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Bahasa Indonesia (ID)</button>
                        <button type="button" @click="activeTab = 'en'" :class="activeTab === 'en' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">English (EN)</button>
                    </nav>
                </div>

                {{-- Konten Tab ID --}}
                @php($translation_id = $carousel->translations->firstWhere('locale', 'id'))
                <div x-show="activeTab === 'id'" class="mt-6 space-y-6">
                    <div>
                        <label for="title_id" class="block text-sm font-medium text-gray-700">Judul (ID)</label>
                        <input type="text" name="translations[id][title]" id="title_id" value="{{ $translation_id->title ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="subtitle_id" class="block text-sm font-medium text-gray-700">Subjudul (ID)</label>
                        <textarea name="translations[id][subtitle]" id="subtitle_id" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_id->subtitle ?? '' }}</textarea>
                    </div>
                    <div>
                        <label for="button_text_id" class="block text-sm font-medium text-gray-700">Teks Tombol (ID)</label>
                        <input type="text" name="translations[id][button_text]" id="button_text_id" value="{{ $translation_id->button_text ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                {{-- Konten Tab EN --}}
                @php($translation_en = $carousel->translations->firstWhere('locale', 'en'))
                <div x-show="activeTab === 'en'" class="mt-6 space-y-6">
                    <div>
                        <label for="title_en" class="block text-sm font-medium text-gray-700">Title (EN)</label>
                        <input type="text" name="translations[en][title]" id="title_en" value="{{ $translation_en->title ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="subtitle_en" class="block text-sm font-medium text-gray-700">Subtitle (EN)</label>
                        <textarea name="translations[en][subtitle]" id="subtitle_en" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_en->subtitle ?? '' }}</textarea>
                    </div>
                    <div>
                        <label for="button_text_en" class="block text-sm font-medium text-gray-700">Button Text (EN)</label>
                        <input type="text" name="translations[en][button_text]" id="button_text_en" value="{{ $translation_en->button_text ?? '' }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>
            </div>

            <div class="mt-8 border-t pt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update</button>
                <a href="{{ route('admin.carousels.index') }}" class="ml-4 text-gray-600 hover:text-gray-800">Batal</a>
            </div>
        </form>
    </div>
@endsection