@extends('admin.layouts.app')

@section('title', 'Kelola Tools')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Kelola Tools</h1>
        <a href="{{ route('admin.tools.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            + Tambah Baru
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-3">Logo</th>
                    <th class="px-4 py-3 text-left">Judul (ID)</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse ($tools as $tool)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <img src="{{ asset('storage/' . $tool->logo_image) }}" alt="Logo" class="h-12 w-auto object-contain">
                        </td>
                        <td class="px-4 py-3">{{ $tool->name }}</td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('admin.tools.edit', $tool) }}" class="text-yellow-500 hover:text-yellow-700 mr-3">Edit</a>
                            
                            <form action="{{ route('admin.tools.destroy', $tool) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus tool ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-5">Belum ada data tool.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection