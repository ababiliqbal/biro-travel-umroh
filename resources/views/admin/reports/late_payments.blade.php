@extends('layouts.admin')

@section('title', 'Laporan Keterlambatan Pembayaran')

@section('content')

    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Laporan Keuangan</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl font-serif">Keterlambatan Pelunasan</h1>
            <p class="mt-2 text-sm text-gray-700">
                Daftar jemaah yang belum lunas mendekati keberangkatan (Jatuh Tempo Lewat).
            </p>
        </div>
        <div class="mt-4 sm:mt-0 print:hidden">
            <button onclick="window.print()"
                class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak Laporan
            </button>
        </div>
    </div>

    <div class="rounded-md bg-red-50 p-4 mb-8 border-l-4 border-red-500 shadow-sm">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Perhatian Diperlukan</h3>
                <div class="mt-2 text-sm text-red-700">
                    <p>Terdapat <strong class="text-red-900">{{ $lateBookings->count() }} jemaah</strong> yang melewati
                        batas waktu pembayaran. Total tunggakan: <strong
                            class="font-mono">{{ 'Rp ' . number_format($lateBookings->sum('debt'), 0, ',', '.') }}</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Jemaah</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Paket &
                            Jadwal</th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Total
                            Tagihan</th>
                        <th scope="col"
                            class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Kekurangan
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Tenggat
                            Waktu</th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider print:hidden">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($lateBookings as $booking)
                        <tr class="hover:bg-red-50/20 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="flex-shrink-0 h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-sm border border-primary/20">
                                        {{ substr($booking->user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-bold text-gray-900">{{ $booking->user->name }}</div>
                                        <div class="text-xs text-gray-500">
                                            {{ $booking->user->jamaahProfile->phone_number ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $booking->package->name }}</div>
                                <div class="text-xs text-gray-500 mt-0.5 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $booking->package->departure_date->format('d M Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Rp {{ number_format($booking->debt, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="text-sm text-red-600 font-bold">{{ $booking->due_date->format('d M Y') }}</div>
                                <div class="text-xs text-red-400 font-medium">Telat {{ $booking->days_overdue }} hari</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center print:hidden">
                                <a href="https://wa.me/{{ $booking->user->jamaahProfile->phone_number ?? '' }}?text=Assalamualaikum%20{{ urlencode($booking->user->name) }},%20kami%20dari%20Barokah%20Travel.%20Mohon%20segera%20melunasi%20pembayaran%20paket%20{{ urlencode($booking->package->name) }}%20sebesar%20Rp%20{{ number_format($booking->debt, 0, '.', '.') }}%20karena%20sudah%20melewati%20tenggat%20waktu.%20Terima%20kasih."
                                    target="_blank"
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                    <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </svg>
                                    Tagih WA
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="mx-auto h-12 w-12 text-gray-300">
                                    <svg class="h-full w-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada keterlambatan</h3>
                                <p class="mt-1 text-sm text-gray-500">Semua jemaah (jatuh tempo hari ini) sudah
                                    lunas. Alhamdulillah.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="md:hidden">
            <div class="divide-y divide-gray-200">
                @forelse($lateBookings as $booking)
                    <div class="p-4 bg-white hover:bg-gray-50 transition-colors">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-sm border border-primary/20">
                                    {{ substr($booking->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900">{{ $booking->user->name }}</h4>
                                    <p class="text-xs text-gray-500">{{ $booking->package->name }}</p>
                                </div>
                            </div>
                            <span
                                class="inline-flex items-center px-2 py-1 rounded text-[10px] font-bold bg-red-100 text-red-700 uppercase">
                                Telat {{ $booking->days_overdue }} Hari
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4 bg-gray-50 p-3 rounded-lg border border-gray-100">
                            <div>
                                <p class="text-xs text-gray-400 mb-0.5">Total Tagihan</p>
                                <p class="text-sm font-medium text-gray-600">Rp
                                    {{ number_format($booking->total_price, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-400 mb-0.5">Kekurangan</p>
                                <p class="text-sm font-bold text-red-600">Rp
                                    {{ number_format($booking->debt, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <div class="text-xs text-gray-500">
                                Tenggat: <span
                                    class="text-red-600 font-medium">{{ $booking->due_date->format('d M Y') }}</span>
                            </div>
                            <a href="https://wa.me/{{ $booking->user->jamaahProfile->phone_number ?? '' }}?text=Assalamualaikum%20{{ urlencode($booking->user->name) }},%20kami%20dari%20Barokah%20Travel.%20Mohon%20segera%20melunasi%20pembayaran%20paket%20{{ urlencode($booking->package->name) }}%20sebesar%20Rp%20{{ number_format($booking->debt, 0, '.', '.') }}%20karena%20sudah%20melewati%20tenggat%20waktu.%20Terima%20kasih."
                                target="_blank"
                                class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white text-xs font-bold rounded-md shadow-sm hover:bg-green-700 transition-colors print:hidden">
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                </svg>
                                Tagih WA
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center">
                        <p class="text-gray-500">Tidak ada data keterlambatan.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

@endsection
