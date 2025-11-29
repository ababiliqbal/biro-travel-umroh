@extends('layouts.admin')

@section('title', 'Daftar Dokumen Paket')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Daftar Dokumen Paket</h1>

    <a href="{{ route('admin.package-documents.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mb-4 inline-block">
       + Tambah Dokumen Baru
    </a>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4">Nama Paket</th>
                    <th class="p-4">Nama Dokumen</th>
                    <th class="p-4">Tipe Dokumen</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($documents as $doc)
                    <tr class="border-t">
                        <td class="p-4">{{ $doc->package->name }}</td>
                        <td class="p-4">{{ $doc->file_name }}</td>
                        <td class="p-4">{{ $doc->document_type }}</td>
                        <td class="p-4 flex gap-2">
                            <!-- Tombol Lihat -->
                            <a href="{{ route('admin.package-documents.show', $doc->id) }}" 
                               class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                 Lihat
                            </a>

                            <!-- Tombol Edit -->
                            <a href="{{ route('admin.package-documents.edit', $doc->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                Edit
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ route('admin.package-documents.destroy', $doc->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-6">Belum ada dokumen tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $documents->links() }}
        </div>
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-6">
        <a href="{{ route('admin.packages.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded inline-block">
           Kembali
        </a>
    </div>
</div>
@endsection
