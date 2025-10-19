@extends('admin.layouts.app')

@section('title', 'Edit FAQ')

@section('content')
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit FAQ</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.faq.update', $faq) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- BAGIAN DATA UTAMA --}}
            <div class="mb-6">
                <label for="sort_order" class="block text-sm font-medium text-gray-700">Nomor Urut</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ $faq->sort_order }}" required
                       class="mt-1 block w-full md:w-1/4 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <hr class="my-6">

            {{-- BAGIAN DATA TRANSLASI (TABS) --}}
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
                    @php($translation_id = $faq->translations->firstWhere('locale', 'id'))
                    <div>
                        <label for="question_id" class="block text-sm font-medium text-gray-700">Pertanyaan (ID)</label>
                        <textarea name="translations[id][question]" id="question_id" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_id->question ?? '' }}</textarea>
                    </div>
                    <div>
                        <label for="answer_id" class="block text-sm font-medium text-gray-700">Jawaban (ID)</label>
                        <textarea name="translations[id][answer]" id="answer_id" rows="5" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_id->answer ?? '' }}</textarea>
                    </div>
                </div>

                {{-- Konten Tab English --}}
                <div x-show="activeTab === 'en'" class="mt-6 space-y-6">
                     @php($translation_en = $faq->translations->firstWhere('locale', 'en'))
                    <div>
                        <label for="question_en" class="block text-sm font-medium text-gray-700">Question (EN)</label>
                        <textarea name="translations[en][question]" id="question_en" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_en->question ?? '' }}</textarea>
                    </div>
                    <div>
                        <label for="answer_en" class="block text-sm font-medium text-gray-700">Answer (EN)</label>
                        <textarea name="translations[en][answer]" id="answer_en" rows="5" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translation_en->answer ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <div class="mt-8 border-t pt-6">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Update</button>
                <a href="{{ route('admin.faq.index') }}" class="ml-4 text-gray-600 hover:text-gray-800">Batal</a>
            </div>
        </form>
    </div>
@endsection