<?php

namespace App\Http\Controllers\Jamaah;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function store(Request $request, \App\Models\Booking $booking)
    {
        if ($booking->user_id !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        if ($booking->due_date && now()->startOfDay()->gt($booking->due_date)) {
            return back()->with('error', 'Maaf, batas waktu pembayaran telah habis. Akses ditutup.');
        }

        $inputDate = \Carbon\Carbon::parse($request->payment_date);
        if ($booking->due_date && $inputDate->gt($booking->due_date)) {
            return back()->with('error', 'Tanggal pembayaran yang Anda masukkan (' . $inputDate->format('d M Y') . ') melewati batas jatuh tempo (' . $booking->due_date->format('d M Y') . ').');
        }
        // -------------------------------

        $totalPaidOrPending = $booking->payments()
            ->whereIn('status', ['verified', 'pending'])
            ->sum('amount');

        $remainingDebt = $booking->total_price - $totalPaidOrPending;

        if ($remainingDebt <= 0) {
            return back()->with('error', 'Pembayaran Anda sudah lunas atau sedang menunggu verifikasi.');
        }

        if ($booking->payments()->where('status', 'pending')->exists()) {
            return back()->with('error', 'Anda memiliki pembayaran yang sedang menunggu verifikasi.');
        }

        $request->validate([
            'amount' => ['required', 'numeric', 'min:10000', 'lte:' . $remainingDebt],
            'payment_date' => 'required|date',
            'proof' => 'required|image|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'amount.lte' => 'Nominal melebihi sisa tagihan.',
        ]);

        $path = null;
        if ($request->hasFile('proof')) {
            $path = $request->file('proof')->store('payments', 'public');
        }

        $booking->payments()->create([
            'amount' => $request->amount,
            'payment_date' => $request->payment_date,
            'payment_method' => 'online',
            'status' => 'pending',
            'proof_of_payment' => $path,
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diunggah. Mohon tunggu verifikasi admin.');
    }
}
