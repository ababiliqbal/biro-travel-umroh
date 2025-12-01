@extends('layouts.jamaah')

@section('title', 'Detail Pendaftaran #' . $booking->id)

@section('content')

    @php
        $totalVerified = $booking->payments->where('status', 'verified')->sum('amount');
        $totalPending = $booking->payments->where('status', 'pending')->sum('amount');
        $remaining = $booking->total_price - $totalVerified;
        $isLunas = $remaining <= 0;

        $isOverdue = $booking->due_date && now()->startOfDay()->gt($booking->due_date) && !$isLunas;
    @endphp

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <div class="flex items-center text-sm text-gray-500 mb-1">
                <a href="{{ route('jamaah.bookings.index') }}" class="hover:text-primary transition">Pendaftaran Saya</a>
                <span class="mx-2">/</span>
                <span class="text-dark font-medium">Detail #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <h1 class="text-2xl md:text-3xl font-serif font-bold text-primary">
                Rincian Pendaftaran
            </h1>
        </div>
        <a href="{{ route('jamaah.bookings.index') }}"
            class="px-4 py-2 bg-white border border-gray-300 text-dark rounded-lg hover:bg-gray-50 transition text-sm font-medium shadow-sm">
            &larr; Kembali
        </a>
    </div>

    {{-- Alert Sukses --}}
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded-r-lg">
            <p class="font-bold">Berhasil!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- [BARU] Alert Error (Controller Validation) --}}
    @if (session('error'))
        <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 shadow-sm rounded-r-lg">
            <p class="font-bold">Gagal!</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-8">

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                    <h2 class="font-bold text-lg text-dark">Informasi Paket</h2>

                    @php
                        $statusClass = match ($booking->status) {
                            'waiting' => 'bg-orange-100 text-orange-700',
                            'approved' => 'bg-green-100 text-green-700',
                            'departed' => 'bg-blue-100 text-blue-700',
                            'rejected' => 'bg-red-100 text-red-700',
                            default => 'bg-gray-100 text-gray-700',
                        };
                        $statusLabel = match ($booking->status) {
                            'waiting' => 'Menunggu Konfirmasi',
                            'approved' => 'Disetujui',
                            'departed' => 'Berangkat',
                            'rejected' => 'Dibatalkan',
                            default => ucfirst($booking->status),
                        };
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $statusClass }}">
                        {{ $statusLabel }}
                    </span>
                </div>

                <div class="p-6">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="w-full md:w-1/3">
                            <div class="aspect-video rounded-lg overflow-hidden bg-gray-200">
                                @if ($booking->package->cover_image_path)
                                    <img src="{{ Storage::url($booking->package->cover_image_path) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400">No Image</div>
                                @endif
                            </div>
                        </div>
                        <div class="w-full md:w-2/3 space-y-3">
                            <h3 class="text-xl font-bold text-primary">{{ $booking->package->name }}</h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600">
                                <div>
                                    <p class="text-gray-400 text-xs">Tanggal Keberangkatan</p>
                                    <p class="font-medium text-dark">
                                        {{ $booking->package->departure_date->format('d F Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs">Lokasi Keberangkatan</p>
                                    <p class="font-medium text-dark">{{ $booking->package->departure_location }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs">Fasilitas Utama</p>
                                    <p class="font-medium text-dark line-clamp-1">
                                        {{ Str::limit($booking->package->facilities, 30) }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-400 text-xs">ID Pendaftaran</p>
                                    <p class="font-medium text-dark">#{{ $booking->id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h2 class="font-bold text-lg text-dark">Riwayat Pembayaran</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-500 font-medium border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3">Metode</th>
                                <th class="px-6 py-3">Bukti</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3 text-right">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($booking->payments as $payment)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">{{ $payment->payment_date->format('d M Y') }}</td>
                                    <td class="px-6 py-4 capitalize">{{ $payment->payment_method }}</td>
                                    <td class="px-6 py-4">
                                        @if ($payment->proof_of_payment)
                                            <a href="{{ Storage::url($payment->proof_of_payment) }}" target="_blank"
                                                class="text-blue-600 hover:underline flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                    </path>
                                                </svg>
                                                Lihat
                                            </a>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($payment->status == 'verified')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Diterima
                                            </span>
                                        @elseif($payment->status == 'failed')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Ditolak
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Menunggu Verifikasi
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right font-bold text-dark">
                                        Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                        Belum ada riwayat pembayaran.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($booking->status == 'approved' || $booking->status == 'departed' || $booking->status == 'completed')
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="font-bold text-lg text-dark">Dokumen Perjalanan</h2>
                    </div>
                    <div class="p-6">
                        @if ($booking->package->documents->count() > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                @foreach ($booking->package->documents as $doc)
                                    <a href="{{ Storage::url($doc->file_path) }}" target="_blank"
                                        class="flex items-center p-3 border rounded-lg hover:bg-gray-50 transition group">
                                        <div
                                            class="w-10 h-10 bg-primary/10 text-primary rounded flex items-center justify-center mr-3 group-hover:bg-primary group-hover:text-white transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-dark">{{ $doc->file_name }}</p>
                                            <p class="text-xs text-gray-500 uppercase">{{ $doc->document_type }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm">Belum ada dokumen yang tersedia untuk paket ini.</p>
                        @endif
                    </div>
                </div>
            @endif

        </div>

        <div class="lg:col-span-1">
            <div class="lg:sticky lg:top-8 space-y-6">

                <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-6">
                    <h3 class="font-serif font-bold text-lg text-primary mb-4">Ringkasan Tagihan</h3>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Total Biaya Paket</span>
                            <span class="font-medium">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-green-600">
                            <span>Sudah Dibayar (Verified)</span>
                            <span class="font-medium">- Rp {{ number_format($totalVerified, 0, ',', '.') }}</span>
                        </div>
                        @if ($totalPending > 0)
                            <div class="flex justify-between text-yellow-600 italic">
                                <span>Menunggu Verifikasi</span>
                                <span class="font-medium">Rp {{ number_format($totalPending, 0, ',', '.') }}</span>
                            </div>
                        @endif

                        <div class="border-t border-dashed border-gray-200 my-2 pt-2"></div>

                        <div class="flex justify-between items-center">
                            <span class="font-bold text-dark">Sisa Tagihan</span>
                            <span class="font-bold text-xl {{ $isLunas ? 'text-green-600' : 'text-red-600' }}">
                                Rp {{ number_format(max(0, $remaining), 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- [BARU] Info Jatuh Tempo --}}
                        @if (!$isLunas && $booking->due_date)
                            <div class="flex justify-between items-center mt-2 pt-2 border-t border-gray-100">
                                <span class="text-gray-500 text-xs font-medium">Jatuh Tempo</span>
                                <span
                                    class="text-sm font-bold {{ $isOverdue ? 'text-red-600 animate-pulse' : 'text-dark' }}">
                                    {{ $booking->due_date->format('d M Y') }}
                                </span>
                            </div>
                        @endif
                    </div>

                    @if ($isLunas)
                        <div
                            class="mt-6 p-3 bg-green-50 text-green-800 rounded-lg text-center text-sm font-bold border border-green-200">
                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            LUNAS
                        </div>
                    @endif
                </div>

                {{-- [UPDATE] FORMULIR: Hanya Tampil Jika TIDAK TELAT (Overdue) --}}
                @if (!$isLunas && $booking->status != 'rejected' && !$isOverdue)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-bold text-lg text-dark mb-2">Upload Bukti Pembayaran</h3>
                        <p class="text-xs text-gray-500 mb-4">
                            Silakan transfer ke <strong class="text-dark">BSI 1234-5678-90</strong> a.n. Barokah Travel,
                            lalu upload buktinya di sini.
                        </p>

                        <form action="{{ route('jamaah.payments.store', $booking->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-dark mb-1">Jumlah Transfer</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-2 text-gray-500 text-sm">Rp</span>
                                        <input type="number" name="amount" min="10000" max="{{ $remaining }}"
                                            value="{{ old('amount', $remaining) }}" required
                                            class="w-full pl-10 pr-3 py-2 border rounded-lg focus:ring-primary focus:border-primary text-sm">
                                    </div>
                                    <p class="text-xs text-gray-400 mt-1">Maksimal Rp
                                        {{ number_format($remaining, 0, ',', '.') }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-dark mb-1">Tanggal Transfer</label>
                                    <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" required
                                        class="w-full px-3 py-2 border rounded-lg focus:ring-primary focus:border-primary text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-dark mb-1">Bukti Foto/PDF</label>
                                    <input type="file" name="proof" accept="image/*,.pdf" required
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                                </div>

                                <button type="submit"
                                    class="w-full py-3 bg-accent text-white font-bold rounded-lg shadow hover:bg-yellow-600 transition">
                                    Kirim Bukti Pembayaran
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                {{-- [BARU] TAMPILAN JIKA TELAT (OVERDUE) --}}
                @if ($isOverdue)
                    <div class="bg-red-50 border border-red-200 rounded-xl p-6 text-center shadow-sm">
                        <div class="inline-flex bg-red-100 p-3 rounded-full mb-3 text-red-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-red-800 font-bold text-lg">Batas Waktu Pembayaran Habis</h3>
                        <p class="text-red-600 text-sm mt-2 mb-4">
                            Anda telah melewati tenggat waktu pembayaran pada tanggal
                            <strong>{{ $booking->due_date->format('d M Y') }}</strong>.<br>
                            Sistem pembayaran otomatis ditutup.
                        </p>
                        <a href="https://wa.me/6281234567890" target="_blank"
                            class="inline-flex items-center justify-center w-full px-4 py-2 bg-red-600 text-white text-sm font-bold rounded-lg hover:bg-red-700 transition shadow-md">
                            Hubungi Admin untuk Bantuan
                        </a>
                    </div>
                @endif

                @if ($booking->status == 'rejected')
                    <div class="bg-red-50 border border-red-200 rounded-xl p-6 text-center">
                        <p class="text-red-700 font-bold mb-2">Pendaftaran Dibatalkan</p>
                        <p class="text-red-600 text-sm">Mohon hubungi admin untuk informasi lebih lanjut.</p>
                    </div>
                @endif

            </div>
        </div>

    </div>

@endsection
