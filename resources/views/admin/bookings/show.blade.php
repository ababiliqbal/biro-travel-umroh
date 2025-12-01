@extends('layouts.admin')

@section('title', 'Detail Pendaftaran #' . $booking->id)

@section('content')

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <div class="flex items-center text-sm text-gray-500 mb-1">
                <a href="{{ route('admin.bookings.index') }}" class="hover:text-primary transition">Manajemen Pendaftaran</a>
                <span class="mx-2">/</span>
                <span class="text-dark font-medium">#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
            <h1 class="text-3xl font-bold text-dark">Detail Pendaftaran</h1>
        </div>
        <a href="{{ route('admin.bookings.index') }}"
            class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium shadow-sm">
            &larr; Kembali
        </a>
    </div>

    @if (session('success'))
        <div
            class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 shadow-sm rounded-r-lg flex justify-between items-center">
            <div><span class="font-bold">Sukses!</span> {{ session('success') }}</div>
            <button onclick="this.parentElement.style.display='none'" class="text-green-700">&times;</button>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 shadow-sm rounded-r-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $totalPaid = $booking->payments->where('status', 'verified')->sum('amount');
        $remaining = $booking->total_price - $totalPaid;
        $progress = $booking->total_price > 0 ? min(100, round(($totalPaid / $booking->total_price) * 100)) : 0;

        // [LOGIKA BARU] Cek lunas & overdue
        $isLunas = $remaining <= 0;
        $isOverdue = $booking->due_date && now()->startOfDay()->gt($booking->due_date) && !$isLunas;
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-8">

            <div class="bg-white rounded-lg shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50">
                    <h2 class="font-bold text-lg text-primary flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Data Jemaah & Paket
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div class="space-y-4">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Nama Jemaah</p>
                                <p class="font-bold text-dark text-lg">{{ $booking->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $booking->user->email }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Nomor Telepon</p>
                                <p class="font-medium text-dark">{{ $booking->user->jamaahProfile->phone_number ?? '-' }}
                                </p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">No. KTP</p>
                                    <p class="font-medium text-dark">{{ $booking->user->jamaahProfile->ktp_number ?? '-' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase tracking-wide">No. Paspor</p>
                                    <p class="font-medium text-dark">
                                        {{ $booking->user->jamaahProfile->passport_number ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4 md:border-l md:pl-8 border-gray-100">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Paket Dipilih</p>
                                <a href="{{ route('admin.packages.edit', $booking->package->id) }}"
                                    class="font-bold text-primary hover:underline text-lg">
                                    {{ $booking->package->name }}
                                </a>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Jadwal Keberangkatan</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span
                                        class="font-medium text-dark">{{ $booking->package->departure_date->format('d F Y') }}</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Lokasi</p>
                                <span class="font-medium text-dark">{{ $booking->package->departure_location }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h2 class="font-bold text-lg text-primary flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01">
                            </path>
                        </svg>
                        Riwayat & Verifikasi Pembayaran
                    </h2>
                    <div class="flex items-center gap-2 text-xs font-bold text-gray-500">
                        <span>Lunas: {{ $progress }}%</span>
                        <div class="w-20 h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-green-500" style="width: {{ $progress }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-white text-gray-500 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-3 font-semibold">Tanggal</th>
                                <th class="px-6 py-3 font-semibold">Metode</th>
                                <th class="px-6 py-3 font-semibold">Jumlah</th>
                                <th class="px-6 py-3 font-semibold">Bukti</th>
                                <th class="px-6 py-3 font-semibold">Status</th>
                                <th class="px-6 py-3 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($booking->payments as $payment)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">{{ $payment->payment_date->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 capitalize">{{ $payment->payment_method }}</td>
                                    <td class="px-6 py-4 font-bold">Rp {{ number_format($payment->amount, 0, ',', '.') }}
                                    </td>
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
                                            <span class="text-gray-400 italic">Manual</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($payment->status == 'verified')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Verified</span>
                                        @elseif($payment->status == 'failed')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Ditolak</span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 animate-pulse">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        @if ($payment->status == 'pending')
                                            <div class="flex justify-end gap-2">
                                                <form action="{{ route('admin.payments.update', $payment->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="verified">
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition"
                                                        title="Setujui Pembayaran">
                                                        &#10003;
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.payments.update', $payment->id) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Yakin ingin menolak pembayaran ini?')">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="failed">
                                                    <button type="submit"
                                                        class="px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 transition"
                                                        title="Tolak Pembayaran">
                                                        &#10005;
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-gray-400 text-xs">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada data
                                        pembayaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="lg:col-span-1">
            <div class="lg:sticky lg:top-24 space-y-6">

                <div class="bg-white rounded-lg shadow-lg border border-gray-100 p-6">
                    <h3 class="font-bold text-dark text-lg mb-4">Status Pendaftaran</h3>

                    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Update Status</label>
                            <select name="status"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-primary focus:border-primary">
                                <option value="waiting" {{ $booking->status == 'waiting' ? 'selected' : '' }}>Menunggu
                                    (Waiting)</option>
                                <option value="approved" {{ $booking->status == 'approved' ? 'selected' : '' }}>Disetujui
                                    (Approved)</option>
                                <option value="departed" {{ $booking->status == 'departed' ? 'selected' : '' }}>Berangkat
                                    (Departed)</option>
                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Selesai
                                    (Completed)</option>
                                <option value="rejected" {{ $booking->status == 'rejected' ? 'selected' : '' }}>Ditolak
                                    (Rejected)</option>
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full py-2 bg-primary text-white font-bold rounded-lg shadow hover:bg-primary/90 transition">
                            Simpan Status
                        </button>
                    </form>
                </div>

                <div class="bg-white rounded-lg shadow-lg border border-gray-100 p-6">
                    <h3 class="font-bold text-dark text-lg mb-4">Ringkasan Keuangan</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between text-gray-600">
                            <span>Total Tagihan</span>
                            <span class="font-medium">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-green-600">
                            <span>Total Dibayar (Verified)</span>
                            <span class="font-medium">- Rp {{ number_format($totalPaid, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-dashed border-gray-200 my-2 pt-2"></div>
                        <div class="flex justify-between items-center">
                            <span class="font-bold text-dark">Sisa Tagihan</span>
                            <span class="font-bold text-xl {{ $remaining > 0 ? 'text-red-600' : 'text-green-600' }}">
                                Rp {{ number_format(max(0, $remaining), 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- [BARU] Info Tenggat Waktu --}}
                        @if (!$isLunas && $booking->due_date)
                            <div class="flex justify-between items-center mt-2 pt-2 border-t border-gray-100">
                                <span class="text-gray-500 text-xs font-medium">Tenggat Waktu</span>
                                <div class="text-right">
                                    <span class="text-sm font-bold {{ $isOverdue ? 'text-red-600' : 'text-dark' }}">
                                        {{ $booking->due_date->format('d M Y') }}
                                    </span>
                                    @if ($isOverdue)
                                        <p class="text-[10px] text-red-500 font-bold animate-pulse">TERLAMBAT</p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg border border-gray-200 p-6">
                    <h3 class="font-bold text-gray-700 text-md mb-2">Input Pembayaran Manual</h3>
                    <p class="text-xs text-gray-500 mb-4">Gunakan ini jika jemaah membayar tunai di kantor.</p>

                    <form action="{{ route('admin.bookings.payments.store', $booking->id) }}" method="POST">
                        @csrf
                        <div class="space-y-3">
                            <div>
                                <input type="number" name="amount" required placeholder="Jumlah (Rp)" min="1000"
                                    class="w-full px-3 py-2 border rounded text-sm focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <input type="date" name="payment_date" required value="{{ date('Y-m-d') }}"
                                    class="w-full px-3 py-2 border rounded text-sm focus:ring-primary focus:border-primary">
                            </div>

                            <button type="submit"
                                onclick="return confirm('Apakah jumlah uang tunai sudah diterima? Data akan langsung berstatus Verified.')"
                                class="w-full py-2 bg-gray-600 text-white font-bold rounded text-xs hover:bg-gray-700 transition">
                                Catat Pembayaran
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </div>

@endsection
