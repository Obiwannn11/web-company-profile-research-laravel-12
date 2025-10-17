@extends('admin.layouts.app')
@section('title', 'Kelola Tim')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Kelola Tim</h1>
        <a href="{{ route('admin.team.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">+ Tambah Baru</a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3 text-left">Nama (ID)</th>
                    <th class="px-4 py-3 text-left">Posisi (ID)</th>
                    <th class="px-4 py-3">Urutan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600">
                @forelse ($teams as $member)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <img src="{{ asset('storage/' . $member->photo) }}" alt="Photo" class="h-12 w-12 rounded-full object-cover">
                        </td>
                        <td class="px-4 py-3">{{ $member->translations->firstWhere('locale', 'id')->name ?? '' }}</td>
                        <td class="px-4 py-3">{{ $member->translations->firstWhere('locale', 'id')->position ?? '' }}</td>
                        <td class="px-4 py-3 text-center">{{ $member->sort_order }}</td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('admin.team.edit', $member) }}" class="text-yellow-500 hover:text-yellow-700 mr-3">Edit</a>
                            <form action="{{ route('admin.team.destroy', $member) }}" method="POST" class="inline-block" onsubmit="return confirm('Anda yakin?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center py-5">Belum ada data anggota tim.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection