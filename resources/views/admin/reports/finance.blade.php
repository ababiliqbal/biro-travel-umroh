@extends('layouts.admin')

@section('title', 'Laporan Keuangan')

@section('content')

    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-3xl font-serif font-bold text-dark mb-2">Laporan Keuangan</h1>
            <p class="text-lg text-dark/80">
                Ringkasan pemasukan yang telah diverifikasi (Sah).
            </p>
        </div>
        <button onclick="window.print()"
            class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition shadow-sm print:hidden">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                </path>
            </svg>
            <span>Cetak Laporan</span>
        </button>
    </div>

    <div class="bg-white rounded-lg shadow-md border border-gray-200 p-5 mb-8 print:hidden">
        <form action="{{ route('admin.reports.finance') }}" method="GET"
            class="flex flex-col md:flex-row items-end gap-4">
            <div class="w-full md:w-auto">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
            </div>
            <div class="w-full md:w-auto">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
            </div>
            <div class="flex gap-2">
                <button type="submit"
                    class="px-6 py-2 bg-primary text-white font-bold rounded-lg hover:bg-primary/90 transition shadow">
                    Filter Data
                </button>
                <a href="{{ route('admin.reports.finance') }}"
                    class="px-4 py-2 bg-gray-100 text-gray-600 font-medium rounded-lg hover:bg-gray-200 transition">
                    Reset (Bulan Ini)
                </a>
            </div>
        </form>
    </div>

    <div class="hidden print:block mb-6">
        <p class="text-xl font-bold">Periode Laporan:</p>
        <p>{{ $startDate->format('d F Y') }} - {{ $endDate->format('d F Y') }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-primary">
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Pemasukan (Verified)</h3>
            <div class="mt-2 flex items-baseline gap-2">
                <span class="text-3xl font-bold text-primary">Rp {{ number_format($totalIncome, 0, ',', '.') }}</span>
            </div>
            <p class="text-sm text-gray-400 mt-1">Dalam periode terpilih</p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-blue-500">
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Transaksi</h3>
            <div class="mt-2">
                <span class="text-3xl font-bold text-blue-600">{{ $totalTransactions }}</span>
                <span class="text-sm text-gray-500 ml-1">transaksi berhasil</span>
            </div>
            <p class="text-sm text-gray-400 mt-1">Dalam periode terpilih</p>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
        <div class="p-5 border-b border-gray-200 bg-gray-50">
            <h2 class="font-bold text-lg text-dark">Rincian Transaksi</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-white text-gray-500 font-bold border-b border-gray-200 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">Tanggal Bayar</th>
                        <th class="px-6 py-3">ID Booking</th>
                        <th class="px-6 py-3">Jemaah</th>
                        <th class="px-6 py-3">Paket</th>
                        <th class="px-6 py-3">Metode</th>
                        <th class="px-6 py-3 text-right">Jumlah (IDR)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($payments as $payment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $payment->payment_date->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 font-mono text-xs">
                                <a href="{{ route('admin.bookings.show', $payment->booking_id) }}"
                                    class="text-primary hover:underline">
                                    #{{ str_pad($payment->booking_id, 5, '0', STR_PAD_LEFT) }}
                                </a>
                            </td>
                            <td class="px-6 py-4 font-medium text-dark">
                                {{ $payment->booking->user->name ?? 'User Dihapus' }}</td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ Str::limit($payment->booking->package->name ?? 'Paket Dihapus', 30) }}</td>
                            <td class="px-6 py-4 capitalize">{{ $payment->payment_method }}</td>
                            <td class="px-6 py-4 text-right font-bold text-dark">
                                {{ number_format($payment->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                Tidak ada data transaksi pada periode ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-gray-50 font-bold text-dark">
                    <tr>
                        <td colspan="5" class="px-6 py-3 text-right">Total (Halaman Ini):</td>
                        <td class="px-6 py-3 text-right">Rp {{ number_format($payments->sum('amount'), 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="p-4 border-t border-gray-200 print:hidden">
            {{ $payments->links() }}
        </div>
    </div>

@endsection
