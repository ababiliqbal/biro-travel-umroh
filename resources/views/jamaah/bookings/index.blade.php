@extends('layouts.jamaah')

@section('title', 'Riwayat Pendaftaran')

@section('content')

    <div class="max-w-7xl mx-auto">

        <div class="mb-8 md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-primary sm:text-3xl sm:truncate font-serif">
                    Pendaftaran Saya
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Kelola dan pantau status perjalanan ibadah umroh Anda.
                </p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('packages.catalog') }}"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-accent hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent transition-colors">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Daftar Paket Baru
                </a>
            </div>
        </div>

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="mb-6 rounded-md bg-green-50 p-4 border border-green-200 shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 flex-1 md:flex md:justify-between">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button @click="show = false" class="text-green-500 hover:text-green-700 focus:outline-none"><span
                                class="sr-only">Dismiss</span><svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                            </svg></button>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div x-data="{ show: true }" x-show="show"
                class="mb-6 rounded-md bg-red-50 p-4 border border-red-200 shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 flex-1 md:flex md:justify-between">
                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button @click="show = false" class="text-red-500 hover:text-red-700 focus:outline-none"><span
                                class="sr-only">Dismiss</span><svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                            </svg></button>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Paket Umroh</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Jadwal</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Total Tagihan</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($bookings as $booking)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="flex-shrink-0 h-12 w-16 bg-gray-100 rounded-md overflow-hidden border border-gray-200">
                                            @if ($booking->package->cover_image_path)
                                                <img src="{{ Storage::url($booking->package->cover_image_path) }}"
                                                    alt="" class="h-full w-full object-cover">
                                            @else
                                                <div class="flex h-full items-center justify-center text-gray-400">
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $booking->package->name }}</div>
                                            <div class="text-xs text-gray-500">ID:
                                                #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 font-medium">
                                        {{ $booking->package->departure_date->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-500 flex items-center mt-0.5">
                                        <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $booking->package->departure_location ?? 'Jakarta' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-primary">Rp
                                        {{ number_format($booking->total_price, 0, ',', '.') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statuses = [
                                            'waiting' => [
                                                'bg' => 'bg-yellow-50',
                                                'text' => 'text-yellow-700',
                                                'ring' => 'ring-yellow-600/20',
                                                'label' => 'Menunggu Bayar',
                                            ],
                                            'approved' => [
                                                'bg' => 'bg-green-50',
                                                'text' => 'text-green-700',
                                                'ring' => 'ring-green-600/20',
                                                'label' => 'Lunas / Disetujui',
                                            ],
                                            'departed' => [
                                                'bg' => 'bg-blue-50',
                                                'text' => 'text-blue-700',
                                                'ring' => 'ring-blue-600/20',
                                                'label' => 'Berangkat',
                                            ],
                                            'completed' => [
                                                'bg' => 'bg-gray-50',
                                                'text' => 'text-gray-600',
                                                'ring' => 'ring-gray-500/10',
                                                'label' => 'Selesai',
                                            ],
                                            'rejected' => [
                                                'bg' => 'bg-red-50',
                                                'text' => 'text-red-700',
                                                'ring' => 'ring-red-600/10',
                                                'label' => 'Dibatalkan',
                                            ],
                                        ];
                                        $st = $statuses[$booking->status] ?? $statuses['waiting'];
                                    @endphp
                                    <span
                                        class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $st['bg'] }} {{ $st['text'] }} {{ $st['ring'] }}">
                                        {{ $st['label'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('jamaah.bookings.show', $booking->id) }}"
                                        class="text-accent hover:text-accent-hover font-semibold hover:underline">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center text-gray-500">
                                    <div
                                        class="mx-auto h-24 w-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                    </div>
                                    <h3 class="mt-2 text-sm font-semibold text-gray-900">Belum ada pendaftaran</h3>
                                    <p class="mt-1 text-sm text-gray-500 mb-6">Anda belum mendaftar paket umroh apapun.</p>
                                    <a href="{{ route('packages.catalog') }}"
                                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                                        Lihat Paket Umroh
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="md:hidden">
                <div class="divide-y divide-gray-100">
                    @forelse($bookings as $booking)
                        <div class="p-4 bg-white hover:bg-gray-50 transition-colors">

                            <div class="flex justify-between items-start mb-3">
                                <span
                                    class="text-xs text-gray-400 font-mono">#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
                                @php
                                    $stMobile = $statuses[$booking->status] ?? $statuses['waiting'];
                                @endphp
                                <span
                                    class="inline-flex items-center rounded-md px-2 py-1 text-[10px] font-bold uppercase ring-1 ring-inset {{ $stMobile['bg'] }} {{ $stMobile['text'] }} {{ $stMobile['ring'] }}">
                                    {{ $stMobile['label'] }}
                                </span>
                            </div>

                            <div class="flex gap-4 mb-4">
                                <div
                                    class="h-20 w-20 flex-shrink-0 bg-gray-200 rounded-lg overflow-hidden border border-gray-100">
                                    @if ($booking->package->cover_image_path)
                                        <img src="{{ Storage::url($booking->package->cover_image_path) }}"
                                            class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center text-gray-400"><svg
                                                class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg></div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold text-gray-900 leading-tight mb-1 line-clamp-2">
                                        {{ $booking->package->name }}</h4>
                                    <p class="text-xs text-gray-500 mb-2 flex items-center">
                                        <svg class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $booking->package->departure_date->format('d M Y') }}
                                    </p>
                                    <p class="text-sm font-bold text-primary">Rp
                                        {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <a href="{{ route('jamaah.bookings.show', $booking->id) }}"
                                class="block w-full text-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-primary hover:border-primary transition-colors">
                                Lihat Detail & Pembayaran
                            </a>
                        </div>
                    @empty
                        <div class="p-8 text-center bg-gray-50">
                            <p class="text-sm text-gray-500 mb-4">Anda belum memiliki riwayat pendaftaran.</p>
                            <a href="{{ route('packages.catalog') }}"
                                class="inline-block px-6 py-2 bg-accent text-white text-sm font-bold rounded-full shadow hover:bg-accent-hover transition-colors">
                                Cari Paket Sekarang
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            @if ($bookings->hasPages())
                <div class="px-5 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $bookings->links() }}
                </div>
            @endif

        </div>
    </div>

@endsection
