@extends('admin.layouts.app')

@section('title', 'Kelola Carousel')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Kelola Carousel</h1>
        <a href="{{ route('admin.carousels.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            + Tambah Slide Baru
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-3">Gambar</th>
                    <th class="px-4 py-3 text-left">Judul (ID)</th>
                    <th class="px-4 py-3">Link URL</th>
                    <th class="px-4 py-3">Urutan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse ($carousels as $slide)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <img src="{{ asset('storage/' . $slide->image) }}" alt="Slide" class="h-16 w-32 object-cover rounded">
                        </td>
                        <td class="px-4 py-3">{{ $slide->translations->firstWhere('locale', 'id')->title ?? '...' }}</td>
                        <td class="px-4 py-3 text-sm font-mono">{{ $slide->link_url }}</td>
                        <td class="px-4 py-3 text-center">{{ $slide->sort_order }}</td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('admin.carousels.edit', $slide) }}" class="text-yellow-500 hover:text-yellow-700 mr-3">Edit</a>
                            <form action="{{ route('admin.carousels.destroy', $slide) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">Belum ada slide carousel.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection