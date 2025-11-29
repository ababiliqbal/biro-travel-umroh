@extends('layouts.admin')

@section('title', 'Tambah Paket Umrah')

@section('content')

<div class="max-w-4xl mx-auto">

    <h1 class="text-2xl font-bold mb-6 text-primary">Tambah Paket Umrah</h1>

    {{-- Alert error --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-6 rounded-xl shadow">
        @csrf

        <div class="grid grid-cols-1 gap-5">

            <div>
                <label class="block font-medium mb-1">Nama Paket</label>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded-lg p-2"
                    placeholder="Contoh: Paket Regular Februari" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" class="w-full border rounded-lg p-2" rows="4"
                    placeholder="Masukkan deskripsi paket umrah..."
                    required>{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block font-medium mb-1">Harga</label>
                <input type="number" name="price" value="{{ old('price') }}" class="w-full border rounded-lg p-2"
                       placeholder="Contoh: 32000000" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Kuota</label>
                <input type="number" name="quota" value="{{ old('quota') }}" class="w-full border rounded-lg p-2"
                       placeholder="Contoh: 45" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Durasi (Hari)</label>
                <input type="number" name="duration" value="{{ old('duration') }}" class="w-full border rounded-lg p-2"
                       placeholder="Contoh: 10" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Tanggal Berangkat</label>
                <input type="date" name="departure_date" value="{{ old('departure_date') }}" class="w-full border rounded-lg p-2" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Fasilitas</label>
                <textarea name="facilities" class="w-full border rounded-lg p-2" rows="3"
                    placeholder="Contoh: Hotel Bintang 5, Pesawat Garuda, Makan 3x, Tour Ziarah"
                    required>{{ old('facilities') }}</textarea>
            </div>

            <div>
                <label class="block font-medium mb-1">Cover Image Paket</label>
                <input type="file" name="cover_image" class="w-full border rounded-lg p-2" accept="image/*">
            </div>

        </div>

        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ route('admin.packages.index') }}" class="px-5 py-2 border rounded-lg hover:bg-gray-100">
                Batal
            </a>
            <button type="submit"
                class="px-6 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-dark transition">
                Simpan Paket
            </button>
        </div>

    </form>

</div>

@endsection
