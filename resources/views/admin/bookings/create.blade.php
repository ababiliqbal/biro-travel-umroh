@extends('layouts.admin')

@section('title', 'Input Pendaftaran Baru')

@section('content')

    <div class="flex items-center mb-6">
        <a href="{{ route('admin.bookings.index') }}" class="flex items-center text-primary hover:underline">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <h1 class="text-3xl font-bold text-dark mb-6">Input Pendaftaran Jemaah</h1>

    @if (session('error'))
        <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 shadow-sm rounded-r-lg">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg p-6 md:p-8 max-w-4xl">

        <form action="{{ route('admin.bookings.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <div>
                    <label for="user_id" class="block text-sm font-bold text-dark mb-2">Pilih Jemaah</label>
                    <select name="user_id" id="user_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary bg-white">
                        <option value="" disabled selected>-- Cari Nama Jemaah --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-2">
                        * Jemaah belum ada di list? <a href="{{ route('admin.users.create') }}"
                            class="text-primary hover:underline font-bold">Buat Akun Jemaah Baru</a> terlebih dahulu.
                    </p>
                </div>

                <div>
                    <label for="package_id" class="block text-sm font-bold text-dark mb-2">Pilih Paket Umroh</label>
                    <select name="package_id" id="package_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary bg-white">
                        <option value="" disabled selected>-- Pilih Paket Tersedia --</option>
                        @foreach ($packages as $package)
                            @php
                                // Hitung sisa kuota (Logic sederhana di view untuk label)
                                $booked = $package->bookings()->where('status', '!=', 'rejected')->count();
                                $sisa = $package->quota - $booked;
                            @endphp
                            <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                {{ $package->name }} | Sisa: {{ $sisa }} | Rp
                                {{ number_format($package->price / 1000000, 1) }} Jt
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-2">
                        * Hanya menampilkan paket dengan kuota tersedia & jadwal masa depan.
                    </p>
                </div>

                <div class="md:col-span-2 bg-blue-50 border border-blue-100 rounded-lg p-4">
                    <h3 class="font-bold text-blue-800 text-sm mb-2">Catatan untuk Admin/Marketing:</h3>
                    <ul class="list-disc pl-5 text-sm text-blue-700 space-y-1">
                        <li>Pastikan Jemaah sudah melengkapi profil (KTP/Paspor) setelah pendaftaran ini dibuat.</li>
                        <li>Status awal pendaftaran adalah <strong>Waiting (Menunggu Pembayaran)</strong>.</li>
                        <li>Total harga akan otomatis diambil dari harga paket saat ini.</li>
                        <li>Anda tercatat sebagai pendaftar (Registered By) untuk booking ini.</li>
                    </ul>
                </div>

            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-4">
                <a href="{{ route('admin.bookings.index') }}"
                    class="px-6 py-3 bg-gray-200 text-dark font-bold rounded-lg hover:bg-gray-300 transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-8 py-3 bg-accent text-white font-bold rounded-lg shadow-lg hover:bg-yellow-600 transition">
                    Simpan Pendaftaran
                </button>
            </div>

        </form>
    </div>

@endsection
