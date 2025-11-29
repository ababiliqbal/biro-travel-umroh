@extends('layouts.admin')

@section('title', 'Daftar Paket Umrah')

@section('content')
<div class="container mx-auto p-6">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-3xl font-bold mb-6">Daftar Paket Umrah</h1>

    <a href="{{ route('admin.packages.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mb-4 inline-block">
       + Tambah Paket Baru
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($packages as $package)
            <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col">
                
                {{-- Cover Image --}}
                @if($package->cover_image_path && Storage::disk('public')->exists($package->cover_image_path))
                    <img src="{{ asset('storage/' . $package->cover_image_path) }}" 
                         alt="{{ $package->name }}" class="h-48 w-full object-cover">
                @else
                    <div class="h-48 w-full bg-gray-200 flex items-center justify-center text-gray-500">
                        Tidak ada gambar
                    </div>
                @endif

                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h2 class="text-lg font-semibold">{{ $package->name }}</h2>
                        <p class="text-gray-700">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                        <p class="text-gray-700">{{ $package->duration }} Hari</p>
                    </div>

                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('admin.packages.edit', $package->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                           Edit
                        </a>

                        <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus paket ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                Hapus
                            </button>
                        </form>

                        <a href="{{ route('admin.packages.show', $package->id) }}"
                           class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded">
                           Lihat
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-3 text-center p-6 text-gray-500">Belum ada paket tersedia.</p>
        @endforelse
    </div>

    {{-- Tombol Atur Dokumen Paket --}}
    <div class="mt-6">
        <a href="{{ route('admin.package-documents.index') }}"
           class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded inline-block">
           Atur Dokumen Paket
        </a>
    </div>
</div>
@endsection
