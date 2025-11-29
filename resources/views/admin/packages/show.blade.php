@extends('layouts.admin')

@section('title', 'Detail Paket Umrah')

@section('content')
<div class="container mx-auto p-6 flex flex-col items-center">
    <h1 class="text-3xl font-bold mb-6">{{ $package->name }}</h1>

    {{-- Cover Image --}}
    @if($package->cover_image_path && Storage::disk('public')->exists($package->cover_image_path))
        <img src="{{ asset('storage/' . $package->cover_image_path) }}" 
             alt="{{ $package->name }}" class="w-full max-w-xl h-auto rounded shadow mb-6">
    @else
        <div class="w-full max-w-xl h-64 bg-gray-200 flex items-center justify-center text-gray-500 rounded mb-6">
            Tidak ada gambar
        </div>
    @endif

    {{-- Paket Details --}}
    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-xl">
        <div class="mb-4">
            <strong>Harga:</strong> Rp {{ number_format($package->price, 0, ',', '.') }}
        </div>
        <div class="mb-4">
            <strong>Durasi:</strong> {{ $package->duration }} Hari
        </div>
        <div class="mb-4">
            <strong>Kuota:</strong> {{ $package->quota }}
        </div>
        <div class="mb-4">
            <strong>Deskripsi:</strong>
            <p class="mt-2 text-gray-700">{{ $package->description ?? '-' }}</p>
        </div>
    </div>

    {{-- Tombol Kembali --}}
    <div class="mt-6">
        <a href="{{ route('admin.packages.index') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">
           Kembali
        </a>
    </div>
</div>
@endsection
