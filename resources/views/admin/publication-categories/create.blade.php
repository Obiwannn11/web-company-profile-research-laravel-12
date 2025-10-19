@extends('admin.layouts.app')

@section('title', 'Tambah Kategori Baru')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Kategori Baru</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.publication-categories.store') }}" method="POST">
            @csrf
            
            {{-- Karena hanya ada input nama, kita tidak perlu memisahkan data utama dan translasi --}}
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
                <div x-show="activeTab === 'id'" class="mt-6">
                    <div>
                        <label for="name_id" class="block text-sm font-medium text-gray-700">Nama Kategori (ID)</label>
                        <input type="text" name="translations[id][name]" id="name_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                {{-- Konten Tab English --}}
                <div x-show="activeTab === 'en'" class="mt-6">
                     <div>
                        <label for="name_en" class="block text-sm font-medium text-gray-700">Category Name (EN)</label>
                        <input type="text" name="translations[en][name]" id="name_en" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                         <p class="text-xs text-gray-500 mt-1">Nama dalam bahasa Inggris akan digunakan untuk membuat slug/URL.</p>
                    </div>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="mt-8 border-t pt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Simpan</button>
                <a href="{{ route('admin.publication-categories.index') }}" class="ml-4 text-gray-600 hover:text-gray-800">Batal</a>
            </div>
        </form>
    </div>
@endsection