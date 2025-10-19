@extends('admin.layouts.app')

@section('title', 'Edit Tool')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Tool: {{ $tool->name }}</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.tools.update', $tool) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- DATA UTAMA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="logo_image" class="block text-sm font-medium text-gray-700">Ganti Logo (Opsional)</label>
                    <input type="file" name="logo_image" id="logo_image" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                    <div class="mt-2">
                        <span class="text-xs text-gray-500">Logo Saat Ini:</span>
                        <img src="{{ asset('storage/' . $tool->logo_image) }}" alt="Current Logo" class="mt-1 h-16 w-auto">
                    </div>
                </div>
                <div>
                    <label for="video_url" class="block text-sm font-medium text-gray-700">URL Video (Opsional)</label>
                    <input type="url" name="video_url" id="video_url" value="{{ $tool->video_url }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="https://www.youtube.com/watch?v=...">
                </div>
            </div>

            <hr class="my-6">

            {{-- DATA TRANSLASI (TABS) --}}
            <div x-data="{ activeTab: 'id' }">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <button type="button" @click="activeTab = 'id'" :class="activeTab === 'id' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Bahasa Indonesia (ID)</button>
                        <button type="button" @click="activeTab = 'en'" :class="activeTab === 'en' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">English (EN)</button>
                    </nav>
                </div>

                {{-- Konten Tab ID --}}
                <div x-show="activeTab === 'id'" class="mt-6 space-y-6">
                    <div>
                        <label for="title_id" class="block text-sm font-medium text-gray-700">Judul (ID)</label>
                        <input type="text" name="translations[id][title]" id="title_id" value="{{ $tool->name }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="description_id" class="block text-sm font-medium text-gray-700">Deskripsi (ID)</label>
                        <textarea name="translations[id][description]" id="description_id" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $tool->description }}</textarea>
                    </div>
                </div>

                {{-- Konten Tab EN --}}
                <div x-show="activeTab === 'en'" class="mt-6 space-y-6">
                    @php($translation_en = $tool->translations->firstWhere('locale', 'en'))
                    <div>
                        <label for="title_en" class="block text-sm font-medium text-gray-700">Title (EN)</label>
                        <input type="text" name="translations[en][title]" id="title_en" value="{{ $translation_en->title ?? '' }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="description_en" class="block text-sm font-medium text-gray-700">Description (EN)</label>
                        <textarea name="translations[en][description]" id="description_en" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_en->description ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="mt-8 border-t pt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update</button>
                <a href="{{ route('admin.tools.index') }}" class="ml-4 text-gray-600 hover:text-gray-800">Batal</a>
            </div>
        </form>
    </div>
@endsection