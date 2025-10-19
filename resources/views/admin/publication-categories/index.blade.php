@extends('admin.layouts.app')

@section('title', 'Kelola Kategori Publikasi')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Kelola Kategori Publikasi</h1>
        <a href="{{ route('admin.publication-categories.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            + Tambah Baru
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left">Nama Kategori (ID)</th>
                    <th class="px-4 py-3 text-left">Nama Kategori (EN)</th>
                    <th class="px-4 py-3 text-left">Slug</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse ($categories as $category)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $category->translations->firstWhere('locale', 'id')->name ?? '' }}</td>
                        <td class="px-4 py-3">{{ $category->translations->firstWhere('locale', 'en')->name ?? '' }}</td>
                        <td class="px-4 py-3 font-mono text-sm">{{ $category->slug }}</td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('admin.publication-categories.edit', $category) }}" class="text-yellow-500 hover:text-yellow-700 mr-3">Edit</a>
                            
                            <form action="{{ route('admin.publication-categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin? Menghapus kategori akan menghapus semua publikasi di dalamnya.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">Belum ada data kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection