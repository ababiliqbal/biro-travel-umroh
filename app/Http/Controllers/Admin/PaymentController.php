<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['booking.user', 'booking.package'])
            ->latest();


        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        } else {
        }

        $payments = $query->paginate(10)->withQueryString();

        return view('admin.payments.index', compact('payments'));
    }

    public function store(Request $request, \App\Models\Booking $booking)
    {
        $totalPaid = $booking->payments()->where('status', 'verified')->sum('amount');
        $remainingDebt = $booking->total_price - $totalPaid;

        if ($remainingDebt <= 0) {
            return back()->with('error', 'Tagihan untuk pendaftaran ini sudah lunas.');
        }

        $request->validate([
            'amount'       => ['required', 'numeric', 'min:1000', 'lte:' . $remainingDebt],
            'payment_date' => 'required|date',
        ], [
            'amount.lte' => 'Nominal pembayaran tidak boleh melebihi sisa tagihan (Rp ' . number_format($remainingDebt, 0, ',', '.') . ').',
        ]);

        $booking->payments()->create([
            'amount'           => $request->amount,
            'payment_date'     => $request->payment_date,
            'payment_method'   => 'manual',
            'status'           => 'verified',
            'proof_of_payment' => null,
            'verified_by'      => auth()->id(),
        ]);

        $newTotalPaid = $totalPaid + $request->amount;

        if ($newTotalPaid >= $booking->total_price && $booking->status == 'waiting') {
            $booking->update(['status' => 'approved']);
        }

        return back()->with('success', 'Pembayaran manual berhasil dicatat.');
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:verified,failed,pending'
        ]);

        $payment->update([
            'status' => $request->status,
            'verified_by' => Auth::id(),
        ]);

        if ($request->status == 'verified') {
            $booking = $payment->booking;

            $totalPaid = $booking->payments()
                ->where('status', 'verified')
                ->sum('amount');

            if ($totalPaid >= $booking->total_price) {
                if ($booking->status == 'waiting') {
                    $booking->update(['status' => 'approved']);
                }
            }
        }

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
