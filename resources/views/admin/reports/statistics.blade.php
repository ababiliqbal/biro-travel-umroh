@extends('layouts.admin')

@section('title', 'Statistik Paket')

@section('content')

    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-serif font-bold text-dark mb-2">Statistik Paket</h1>
            <p class="text-lg text-dark/80">
                Analisa performa penjualan dan tingkat okupansi paket umroh.
            </p>
        </div>
        <button onclick="window.print()"
            class="hidden md:flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition shadow-sm print:hidden">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                </path>
            </svg>
            <span>Cetak PDF</span>
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 print:mb-4">

        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-accent relative overflow-hidden">
            <div class="absolute right-0 top-0 p-4 opacity-10">
                <svg class="w-24 h-24 text-accent" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                </svg>
            </div>
            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Paket Terlaris</h3>
            @if ($topPackage)
                <p class="text-xl font-bold text-dark truncate" title="{{ $topPackage->name }}">
                    {{ $topPackage->name }}
                </p>
                <p class="text-sm text-accent mt-1 font-bold">
                    {{ $topPackage->bookings_count }} Pendaftar
                </p>
            @else
                <p class="text-lg text-gray-400">-</p>
            @endif
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-primary">
            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Total Jemaah Terdaftar</h3>
            <p class="text-3xl font-bold text-primary">{{ $totalPendaftarAll }}</p>
            <p class="text-sm text-gray-400 mt-1">di semua paket aktif</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-red-400">
            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Peminat Terendah</h3>
            @if ($lowPackage && $lowPackage->bookings_count < 5)
                <p class="text-xl font-bold text-dark truncate" title="{{ $lowPackage->name }}">
                    {{ $lowPackage->name }}
                </p>
                <p class="text-sm text-red-500 mt-1 font-bold">
                    Baru {{ $lowPackage->bookings_count }} Pendaftar
                </p>
            @else
                <p class="text-lg text-green-600">Semua paket laku keras!</p>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
        <div class="p-5 border-b border-gray-200 bg-gray-50">
            <h2 class="font-bold text-lg text-dark">Detail Performa per Paket</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full align-middle text-sm text-left">
                <thead class="bg-white text-gray-500 font-bold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 uppercase tracking-wider w-1/3">Nama Paket</th>
                        <th class="px-6 py-4 uppercase tracking-wider text-center">Kuota</th>
                        <th class="px-6 py-4 uppercase tracking-wider text-center">Terisi</th>
                        <th class="px-6 py-4 uppercase tracking-wider w-1/4">Tingkat Okupansi</th>
                        <th class="px-6 py-4 uppercase tracking-wider text-right">Potensi Omzet</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($packages as $package)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="font-bold text-dark text-base">{{ $package->name }}</div>
                                <div class="text-xs text-gray-500 mt-1">
                                    Berangkat: {{ $package->departure_date->format('d M Y') }}
                                </div>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="bg-gray-100 text-gray-600 py-1 px-3 rounded-full font-bold text-xs">
                                    {{ $package->quota }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center">
                                <span class="font-bold text-primary text-lg">
                                    {{ $package->bookings_count }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex-1 h-3 bg-gray-200 rounded-full overflow-hidden">
                                        @php
                                            $color = 'bg-green-500';
                                            if ($package->occupancy_rate < 30) {
                                                $color = 'bg-red-500';
                                            } elseif ($package->occupancy_rate < 70) {
                                                $color = 'bg-yellow-500';
                                            }
                                        @endphp
                                        <div class="h-full {{ $color }}"
                                            style="width: {{ $package->occupancy_rate }}%"></div>
                                    </div>
                                    <span class="text-xs font-bold w-10 text-right">{{ $package->occupancy_rate }}%</span>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-right font-mono font-medium text-dark">
                                Rp {{ number_format($package->bookings_sum_total_price ?? 0, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                Belum ada data paket.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
