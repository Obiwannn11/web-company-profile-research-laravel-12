@extends('admin.layouts.app')
@section('title', 'Kelola Publikasi')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Kelola Publikasi</h1>
        <a href="{{ route('admin.publications.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">+ Tambah Baru</a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-3">Gambar</th>
                    <th class="px-4 py-3 text-left">Judul (ID)</th>
                    <th class="px-4 py-3 text-left">Kategori</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse ($publications as $publication)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3"><img src="{{ asset('storage/' . $publication->hero_image) }}" alt="Image" class="h-12 w-auto object-cover"></td>
                        <td class="px-4 py-3">{{ $publication->translations->firstWhere('locale', 'id')->title ?? '' }}</td>
                        <td class="px-4 py-3">{{ $publication->category->translations->firstWhere('locale', 'id')->name ?? 'N/A' }}</td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('admin.publications.edit', $publication) }}" class="text-yellow-500 hover:text-yellow-700 mr-3">Edit</a>
                            <form action="{{ route('admin.publications.destroy', $publication) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-5">Belum ada data publikasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection