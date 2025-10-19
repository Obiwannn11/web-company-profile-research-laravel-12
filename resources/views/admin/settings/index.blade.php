@extends('admin.layouts.app')

@section('title', 'Pengaturan Konten Situs')

@section('content')
    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Pengaturan Konten Situs</h1>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-8">
                @foreach ($settings as $key => $translations)
                    <div>
                        <label class="block text-lg font-medium text-gray-800">{{ Str::title(str_replace('_', ' ', $key)) }}</label>
                        <p class="text-sm text-gray-500 mb-2">Kunci: <code class="bg-gray-200 px-1 rounded">{{ $key }}</code></p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Input Bahasa Indonesia --}}
                            <div>
                                <label for="{{ $key }}_id" class="block text-sm font-medium text-gray-700">Bahasa Indonesia (ID)</label>
                                <textarea name="contents[{{ $key }}][id]" id="{{ $key }}_id" rows="3" 
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translations['id'] ?? '' }}</textarea>
                            </div>
                            {{-- Input English --}}
                            <div>
                                <label for="{{ $key }}_en" class="block text-sm font-medium text-gray-700">English (EN)</label>
                                <textarea name="contents[{{ $key }}][en]" id="{{ $key }}_en" rows="3" 
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $translations['en'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>

            <div class="mt-8">
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
@endsection