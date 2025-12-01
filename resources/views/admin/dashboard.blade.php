@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <div class="mb-8">
        <h1 class="text-3xl font-serif font-bold text-dark">Dashboard Ringkasan</h1>
        <p class="text-gray-500">
            Selamat datang kembali, {{ Auth::user()->name }}! Berikut adalah performa biro travel hari ini.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-3 rounded-full bg-blue-50 text-blue-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Total Jemaah</p>
                <p class="text-2xl font-bold text-dark">{{ $totalJamaah }}</p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-3 rounded-full bg-purple-50 text-purple-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Booking Baru (Bulan Ini)</p>
                <p class="text-2xl font-bold text-dark">{{ $newBookingsThisMonth }}</p>
            </div>
        </div>

        <div
            class="bg-white p-6 rounded-xl shadow-md border-l-4 border-yellow-400 flex items-center transform transition hover:scale-105">
            <div class="p-3 rounded-full bg-yellow-50 text-yellow-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Perlu Verifikasi</p>
                <p class="text-2xl font-bold text-yellow-600">{{ $pendingPayments }} <span
                        class="text-sm font-normal text-gray-400">Pembayaran</span></p>
            </div>
            <a href="{{ route('admin.payments.index', ['status' => 'pending']) }}" class="absolute inset-0"></a>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center">
            <div class="p-3 rounded-full bg-green-50 text-green-600 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01">
                    </path>
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">Omzet ({{ date('M Y') }})</p>
                <p class="text-xl font-bold text-primary truncate"
                    title="Rp {{ number_format($incomeThisMonth, 0, ',', '.') }}">
                    Rp {{ number_format($incomeThisMonth / 1000000, 1, ',', '.') }} Jt
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                <h3 class="font-bold text-dark">5 Pendaftaran Terakhir</h3>
                <a href="{{ route('admin.bookings.index') }}" class="text-xs text-primary font-bold hover:underline">Lihat
                    Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentBookings as $booking)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <p class="font-bold text-dark text-xs">{{ $booking->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $booking->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <span
                                        class="text-xs text-gray-600 block truncate w-32">{{ $booking->package->name }}</span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    @php
                                        $badge = match ($booking->status) {
                                            'waiting' => 'bg-yellow-100 text-yellow-800',
                                            'approved' => 'bg-green-100 text-green-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <span class="px-2 py-1 rounded text-[10px] font-bold uppercase {{ $badge }}">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-4 text-center text-gray-400">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                <h3 class="font-bold text-dark">5 Pembayaran Terakhir</h3>
                <a href="{{ route('admin.payments.index') }}" class="text-xs text-primary font-bold hover:underline">Lihat
                    Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentPayments as $payment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <p class="font-bold text-dark text-xs">{{ $payment->booking->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $payment->payment_date->format('d/m/Y') }}</p>
                                </td>
                                <td class="px-4 py-3 font-medium text-dark">
                                    Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    @if ($payment->status == 'verified')
                                        <span class="text-green-600 text-xs font-bold">✓ Sah</span>
                                    @elseif($payment->status == 'pending')
                                        <a href="{{ route('admin.payments.index') }}"
                                            class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-[10px] font-bold hover:bg-yellow-200">
                                            Cek
                                        </a>
                                    @else
                                        <span class="text-red-600 text-xs font-bold">X Gagal</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-4 text-center text-gray-400">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
