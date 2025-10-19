@extends('admin.layouts.app')

@section('title', 'Kelola FAQ')

@section('content')
    {{-- Header Halaman --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Kelola FAQ</h1>
        <a href="{{ route('admin.faq.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            + Tambah Baru
        </a>
    </div>

    {{-- Tabel Konten --}}
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left">Pertanyaan (ID)</th>
                    <th class="px-4 py-3">Urutan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse ($faqs as $faq)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">
                            {{-- Mengambil terjemahan Bahasa Indonesia dan membatasinya agar tidak terlalu panjang --}}
                            {{ Str::limit($faq->translations->firstWhere('locale', 'id')->question ?? 'Pertanyaan tidak tersedia', 70) }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            {{ $faq->sort_order }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            {{-- Tombol Edit --}}
                            <a href="{{ route('admin.faq.edit', $faq) }}" class="text-yellow-500 hover:text-yellow-700 mr-3">Edit</a>
                            
                            {{-- Form untuk Tombol Hapus --}}
                            <form action="{{ route('admin.faq.destroy', $faq) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus FAQ ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    {{-- Pesan jika tidak ada data --}}
                    <tr>
                        <td colspan="3" class="text-center py-5">Belum ada data FAQ.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection