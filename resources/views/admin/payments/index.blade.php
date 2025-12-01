@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran')

@section('content')

    <div class="mb-8">
        <h1 class="text-3xl font-serif font-bold text-dark mb-2">Verifikasi Pembayaran</h1>
        <p class="text-lg text-dark/80">
            Monitor dan verifikasi pembayaran yang masuk dari jemaah.
        </p>
    </div>

    @if (session('success'))
        <div
            class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded-r-lg flex justify-between items-center">
            <div>
                <span class="font-bold">Sukses!</span>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.style.display='none'" class="text-green-700">&times;</button>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">

        <div class="p-5 border-b border-gray-200 bg-gray-50 flex flex-col md:flex-row gap-4 justify-between items-center">

            <form action="{{ route('admin.payments.index') }}" method="GET"
                class="w-full md:w-auto flex-1 flex flex-col md:flex-row gap-3">

                <div class="relative w-full md:w-64">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari ID Booking..."
                        class="pl-10 pr-4 py-2 w-full border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm">
                </div>

                <div class="relative w-full md:w-48">
                    <select name="status" onchange="this.form.submit()"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary text-sm bg-white cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu (Pending)
                        </option>
                        <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Diterima (Verified)
                        </option>
                        <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Ditolak (Failed)
                        </option>
                    </select>
                </div>
            </form>

            @if (request('search') || request('status'))
                <a href="{{ route('admin.payments.index') }}" class="text-sm text-red-600 hover:underline font-medium">
                    Reset Filter
                </a>
            @endif
        </div>

        <div class="hidden md:block overflow-x-auto">
            <table class="w-full align-middle text-sm text-left">
                <thead class="bg-white text-gray-500 font-bold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 uppercase tracking-wider">ID Booking</th>
                        <th class="px-6 py-4 uppercase tracking-wider">Jemaah & Paket</th>
                        <th class="px-6 py-4 uppercase tracking-wider">Metode & Tgl</th>
                        <th class="px-6 py-4 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-4 uppercase tracking-wider">Bukti</th>
                        <th class="px-6 py-4 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($payments as $payment)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('admin.bookings.show', $payment->booking_id) }}"
                                    class="font-mono font-bold text-primary hover:underline">
                                    #{{ str_pad($payment->booking_id, 5, '0', STR_PAD_LEFT) }}
                                </a>
                            </td>

                            <td class="px-6 py-4">
                                <div class="font-medium text-dark">{{ $payment->booking->user->name }}</div>
                                <div class="text-xs text-gray-500 mt-0.5 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                    {{ Str::limit($payment->booking->package->name, 20) }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="capitalize text-dark">{{ $payment->payment_method }}</div>
                                <div class="text-xs text-gray-500">{{ $payment->payment_date->format('d M Y') }}</div>
                            </td>

                            <td class="px-6 py-4 font-medium text-dark">
                                Rp {{ number_format($payment->amount, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                @if ($payment->proof_of_payment)
                                    <a href="{{ Storage::url($payment->proof_of_payment) }}" target="_blank"
                                        class="text-blue-600 hover:text-blue-800 text-xs font-bold flex items-center gap-1 bg-blue-50 px-2 py-1 rounded w-fit">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        Lihat
                                    </a>
                                @else
                                    <span class="text-xs text-gray-400 italic">Manual</span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                @if ($payment->status == 'verified')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                        Verified
                                    </span>
                                @elseif($payment->status == 'failed')
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 border border-red-200">
                                        Ditolak
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200 animate-pulse">
                                        Pending
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 text-right">
                                @if ($payment->status == 'pending')
                                    <div class="flex justify-end gap-2">
                                        <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="verified">
                                            <button type="submit"
                                                class="p-1.5 bg-green-100 text-green-700 rounded hover:bg-green-600 hover:text-white transition"
                                                title="Setujui">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menolak pembayaran ini?')">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="failed">
                                            <button type="submit"
                                                class="p-1.5 bg-red-100 text-red-700 rounded hover:bg-red-600 hover:text-white transition"
                                                title="Tolak">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-green-100 mb-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p>Tidak ada pembayaran yang sesuai filter.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="md:hidden">
            @forelse($payments as $payment)
                <div class="p-4 border-b border-gray-200 last:border-none">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h3 class="font-bold text-dark text-sm">{{ $payment->booking->user->name }}</h3>
                            <p class="text-xs text-gray-500">{{ $payment->booking->package->name }}</p>
                        </div>
                        @if ($payment->status == 'verified')
                            <span
                                class="px-2 py-1 rounded text-[10px] font-bold bg-green-100 text-green-800">Verified</span>
                        @elseif($payment->status == 'failed')
                            <span class="px-2 py-1 rounded text-[10px] font-bold bg-red-100 text-red-800">Ditolak</span>
                        @else
                            <span
                                class="px-2 py-1 rounded text-[10px] font-bold bg-yellow-100 text-yellow-800">Pending</span>
                        @endif
                    </div>

                    <div class="flex justify-between items-end mb-3">
                        <div class="text-sm">
                            <p class="text-gray-500 text-xs">Jumlah</p>
                            <p class="font-bold text-dark">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right">
                            @if ($payment->proof_of_payment)
                                <a href="{{ Storage::url($payment->proof_of_payment) }}" target="_blank"
                                    class="text-blue-600 text-xs hover:underline">Lihat Bukti</a>
                            @endif
                        </div>
                    </div>

                    @if ($payment->status == 'pending')
                        <div class="grid grid-cols-2 gap-2 mt-3">
                            <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="verified">
                                <button
                                    class="w-full py-2 bg-green-600 text-white text-xs font-bold rounded shadow-sm">Setujui</button>
                            </form>
                            <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST"
                                onsubmit="return confirm('Yakin?')">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="failed">
                                <button
                                    class="w-full py-2 bg-red-600 text-white text-xs font-bold rounded shadow-sm">Tolak</button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <div class="p-8 text-center text-gray-500">
                    Tidak ada data.
                </div>
            @endforelse
        </div>

        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $payments->links() }}
        </div>

    </div>

@endsection
