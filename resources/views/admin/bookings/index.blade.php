@extends('layouts.admin')

@section('title', 'Manajemen Pendaftaran')

@section('content')

    <div class="mb-8 flex flex-col md:flex-row justify-between items-center">
        <div>
            <h1 class="text-3xl font-serif font-bold text-dark mb-2">Manajemen Pendaftaran</h1>
            <p class="text-lg text-dark/80">Monitor dan kelola seluruh pendaftaran jemaah.</p>
        </div>
        <a href="{{ route('admin.bookings.create') }}"
            class="mt-4 md:mt-0 flex items-center gap-2 px-5 py-3 font-bold text-white bg-accent rounded-lg shadow-lg hover:bg-yellow-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
            <span>Input Pendaftaran Baru</span>
        </a>
    </div>

    @if (session('success'))
        <div
            class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded-r-lg flex justify-between items-center">
            <div>
                <span class="font-bold">Berhasil!</span>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.style.display='none'" class="text-green-700">&times;</button>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">

        <div class="p-5 border-b border-gray-200 bg-gray-50 flex flex-col md:flex-row gap-4 justify-between items-center">

            <form action="{{ route('admin.bookings.index') }}" method="GET"
                class="w-full md:w-auto flex-1 flex flex-col md:flex-row gap-3">
                <div class="relative w-full md:w-64">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama jemaah..."
                        class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm">
                </div>

                <div class="relative w-full md:w-48">
                    <select name="status" onchange="this.form.submit()"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm bg-white cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="waiting" {{ request('status') == 'waiting' ? 'selected' : '' }}>Menunggu (Waiting)
                        </option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui
                            (Approved)</option>
                        <option value="departed" {{ request('status') == 'departed' ? 'selected' : '' }}>Berangkat
                            (Departed)</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai
                            (Completed)</option>
                        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak (Rejected)
                        </option>
                    </select>
                </div>
            </form>

            @if (request('search') || request('status'))
                <a href="{{ route('admin.bookings.index') }}" class="text-sm text-red-600 hover:underline font-medium">
                    Reset Filter
                </a>
            @endif
        </div>

        <div class="hidden md:block overflow-x-auto">
            <table class="w-full align-middle text-sm text-left">
                <thead class="bg-white text-gray-500 font-bold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 uppercase tracking-wider">ID & Tgl</th>
                        <th class="px-6 py-4 uppercase tracking-wider">Jemaah</th>
                        <th class="px-6 py-4 uppercase tracking-wider">Paket Umroh</th>
                        <th class="px-6 py-4 uppercase tracking-wider">Total Harga</th>
                        <th class="px-6 py-4 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="font-mono font-bold text-primary">#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
                                <div class="text-xs text-gray-500 mt-1">{{ $booking->created_at->format('d/m/Y H:i') }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div
                                        class="h-8 w-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold mr-3">
                                        {{ substr($booking->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-medium text-dark">{{ $booking->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $booking->user->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-medium text-dark">{{ $booking->package->name }}</div>
                                <div class="text-xs text-gray-500 flex items-center gap-1 mt-0.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $booking->package->departure_date->format('d M Y') }}
                                </div>
                            </td>

                            <td class="px-6 py-4 font-medium text-dark">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                @php
                                    $statusConfig = [
                                        'waiting' => [
                                            'bg' => 'bg-yellow-100',
                                            'text' => 'text-yellow-800',
                                            'label' => 'Menunggu',
                                        ],
                                        'approved' => [
                                            'bg' => 'bg-green-100',
                                            'text' => 'text-green-800',
                                            'label' => 'Disetujui',
                                        ],
                                        'departed' => [
                                            'bg' => 'bg-blue-100',
                                            'text' => 'text-blue-800',
                                            'label' => 'Berangkat',
                                        ],
                                        'completed' => [
                                            'bg' => 'bg-gray-100',
                                            'text' => 'text-gray-800',
                                            'label' => 'Selesai',
                                        ],
                                        'rejected' => [
                                            'bg' => 'bg-red-100',
                                            'text' => 'text-red-800',
                                            'label' => 'Ditolak',
                                        ],
                                    ];
                                    $config = $statusConfig[$booking->status] ?? $statusConfig['waiting'];
                                @endphp
                                <span
                                    class="px-2.5 py-1 rounded-full text-xs font-bold uppercase {{ $config['bg'] }} {{ $config['text'] }}">
                                    {{ $config['label'] }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-md text-xs font-bold text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition">
                                    Kelola
                                    <svg class="ml-1.5 w-3 h-3 text-gray-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                        </path>
                                    </svg>
                                    <p>Tidak ada data pendaftaran ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="md:hidden">
            @forelse($bookings as $booking)
                <div class="p-4 border-b border-gray-200 last:border-none">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <span
                                class="font-mono text-xs text-gray-500">#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
                            <h3 class="font-bold text-dark text-sm">{{ $booking->user->name }}</h3>
                        </div>
                        @php
                            $config = $statusConfig[$booking->status] ?? $statusConfig['waiting'];
                        @endphp
                        <span
                            class="px-2 py-1 rounded text-[10px] font-bold uppercase {{ $config['bg'] }} {{ $config['text'] }}">
                            {{ $config['label'] }}
                        </span>
                    </div>

                    <div class="text-sm text-gray-600 mb-3 space-y-1">
                        <p class="flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            {{ $booking->package->name }}
                        </p>
                        <p class="font-medium text-dark">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                    </div>

                    <a href="{{ route('admin.bookings.show', $booking->id) }}"
                        class="block w-full text-center px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg text-sm font-bold text-gray-700 hover:bg-gray-100">
                        Kelola
                    </a>
                </div>
            @empty
                <div class="p-8 text-center text-gray-500">
                    Tidak ada data.
                </div>
            @endforelse
        </div>

        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $bookings->links() }}
        </div>

    </div>

@endsection
