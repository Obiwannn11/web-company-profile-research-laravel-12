@extends('admin.layouts.app')

@section('title', 'Edit Item R&D')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Item R&D: {{ $project->translations->firstWhere('locale', 'id')->title ?? '' }}</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- BAGIAN DATA UTAMA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Tipe</label>
                    <select name="type" id="type" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="project" {{ $project->type == 'project' ? 'selected' : '' }}>Project</option>
                        <option value="research" {{ $project->type == 'research' ? 'selected' : '' }}>Research</option>
                    </select>
                </div>
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                    <select name="category" id="category" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="external" {{ $project->category == 'external' ? 'selected' : '' }}>Eksternal</option>
                        <option value="internal" {{ $project->category == 'internal' ? 'selected' : '' }}>Internal</option>
                    </select>
                </div>
                <div>
                    <label for="icon_image" class="block text-sm font-medium text-gray-700">Ganti Ikon (Opsional)</label>
                    <input type="file" name="icon_image" id="icon_image" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                    <div class="mt-2">
                        <span class="text-xs text-gray-500">Ikon Saat Ini:</span>
                        <img src="{{ asset('storage/' . $project->icon_image) }}" alt="Current Icon" class="mt-1 h-16 w-16 object-cover">
                    </div>
                </div>
                 <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700">Nomor Urut</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ $project->sort_order }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
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
                    @php($translation_id = $project->translations->firstWhere('locale', 'id'))
                    <div>
                        <label for="title_id" class="block text-sm font-medium text-gray-700">Judul (ID)</label>
                        <input type="text" name="translations[id][title]" id="title_id" value="{{ $translation_id->title ?? '' }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="details_id" class="block text-sm font-medium text-gray-700">Detail Singkat (ID)</label>
                        <input type="text" name="translations[id][details]" id="details_id" value="{{ $translation_id->details ?? '' }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="description_id" class="block text-sm font-medium text-gray-700">Deskripsi Panjang (ID)</label>
                        <textarea name="translations[id][description]" id="description_id" rows="5" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_id->description ?? '' }}</textarea>
                    </div>
                </div>

                {{-- Konten Tab English --}}
                <div x-show="activeTab === 'en'" class="mt-6 space-y-6">
                    @php($translation_en = $project->translations->firstWhere('locale', 'en'))
                     <div>
                        <label for="title_en" class="block text-sm font-medium text-gray-700">Title (EN)</label>
                        <input type="text" name="translations[en][title]" id="title_en" value="{{ $translation_en->title ?? '' }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="details_en" class="block text-sm font-medium text-gray-700">Short Details (EN)</label>
                        <input type="text" name="translations[en][details]" id="details_en" value="{{ $translation_en->details ?? '' }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="description_en" class="block text-sm font-medium text-gray-700">Long Description (EN)</label>
                        <textarea name="translations[en][description]" id="description_en" rows="5" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_en->description ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="mt-8 border-t pt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update</button>
                <a href="{{ route('admin.projects.index') }}" class="ml-4 text-gray-600 hover:text-gray-800">Batal</a>
            </div>
        </form>
    </div>
@endsection