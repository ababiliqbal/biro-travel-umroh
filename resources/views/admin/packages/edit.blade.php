@extends('layouts.admin')

@section('title', 'Edit Paket Umrah')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Edit Paket Umrah</h1>

    <form action="{{ route('admin.packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-semibold mb-2">Nama Paket</label>
            <input type="text" name="name" value="{{ old('name', $package->name) }}"
                class="w-full border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Harga</label>
            <input type="number" name="price" value="{{ old('price', $package->price) }}"
                class="w-full border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Durasi (Hari)</label>
            <input type="number" name="duration" value="{{ old('duration', $package->duration) }}"
                class="w-full border-gray-300 rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Deskripsi</label>
            <textarea name="description" rows="4"
                class="w-full border-gray-300 rounded p-2">{{ old('description', $package->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-2">Cover Image</label>
            @if($package->cover_image_path)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $package->cover_image_path) }}" alt="Cover" class="w-48 h-auto rounded">
                </div>
            @endif
            <input type="file" name="cover_image" class="w-full border-gray-300 rounded p-2">
            <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengganti gambar</p>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.packages.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
