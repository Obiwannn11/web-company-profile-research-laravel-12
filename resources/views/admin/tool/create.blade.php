@extends('admin.layouts.app')

@section('title', 'Tambah Tool Baru')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Tool Baru</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.tools.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- DATA UTAMA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="logo_image" class="block text-sm font-medium text-gray-700">Logo</label>
                    <input type="file" name="logo_image" id="logo_image" required
                           class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                </div>
                <div>
                    <label for="video_url" class="block text-sm font-medium text-gray-700">URL Video (Opsional)</label>
                    <input type="url" name="video_url" id="video_url"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <hr class="my-6">
            {{-- DATA TRANSLASI --}}
            <div x-data="{ activeTab: 'id' }">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button type="button" @click="activeTab = 'id'" :class="activeTab === 'id' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Bahasa Indonesia (ID)</button>
                        <button type="button" @click="activeTab = 'en'" :class="activeTab === 'en' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700'" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">English (EN)</button>
                    </nav>
                </div>
                {{-- TAB ID --}}
                <div x-show="activeTab === 'id'" class="mt-6 space-y-6">
                    <div>
                        <label for="title_id" class="block text-sm font-medium text-gray-700">Judul (ID)</label>
                        <input type="text" name="translations[id][title]" id="title_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="description_id" class="block text-sm font-medium text-gray-700">Deskripsi (ID)</label>
                        <textarea name="translations[id][description]" id="description_id" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                </div>
                {{-- TAB EN --}}
                <div x-show="activeTab === 'en'" class="mt-6 space-y-6">
                    <div>
                        <label for="title_en" class="block text-sm font-medium text-gray-700">Title (EN)</label>
                        <input type="text" name="translations[en][title]" id="title_en" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label for="description_en" class="block text-sm font-medium text-gray-700">Description (EN)</label>
                        <textarea name="translations[en][description]" id="description_en" rows="4" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t pt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                <a href="{{ route('admin.tools.index') }}" class="ml-4 text-gray-600 hover:text-gray-800">Batal</a>
            </div>
        </form>
    </div>
@endsection