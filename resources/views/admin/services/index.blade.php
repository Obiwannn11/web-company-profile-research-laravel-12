@extends('admin.layouts.app')

@section('title', 'Kelola Layanan')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Kelola Layanan (Services)</h1>
        <a href="{{ route('admin.services.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            + Tambah Baru
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full table-auto">
            <thead class="bg-gray-200 text-gray-700">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3 text-left">Judul (ID)</th>
                    <th class="px-4 py-3 text-left">Slug</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse ($services as $service)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 text-center">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">
                            {{-- Mengambil terjemahan bahasa Indonesia --}}
                            {{ $service->translations->firstWhere('locale', 'id')->title ?? 'Tidak ada judul' }}
                        </td>
                        <td class="px-4 py-3 font-mono text-sm">{{ $service->slug }}</td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('admin.services.edit', $service) }}" class="text-yellow-500 hover:text-yellow-700 mr-3">Edit</a>
                            
                            {{-- Form untuk tombol Hapus --}}
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin ingin menghapus layanan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5">Belum ada data service.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection