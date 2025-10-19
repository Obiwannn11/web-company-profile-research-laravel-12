@extends('admin.layouts.app')
@section('title', 'Kelola R&D Projects')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Kelola R&D Projects & Research</h1>
        <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">+ Tambah Baru</a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-3">Ikon</th>
                    <th class="px-4 py-3 text-left">Judul (ID)</th>
                    <th class="px-4 py-3">Tipe</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse ($projects as $project)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3"><img src="{{ asset('storage/' . $project->icon_image) }}" alt="Icon" class="h-10 w-10 object-cover"></td>
                        <td class="px-4 py-3">{{ $project->translations->firstWhere('locale', 'id')->title ?? '' }}</td>
                        <td class="px-4 py-3 capitalize">{{ $project->type }}</td>
                        <td class="px-4 py-3 capitalize">{{ $project->category }}</td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="text-yellow-500 hover:text-yellow-700 mr-3">Edit</a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-5">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection