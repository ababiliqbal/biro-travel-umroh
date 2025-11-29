<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    // Menampilkan semua pembayaran
    public function index()
    {
        $payments = Payment::latest()->get();
        return view('admin.payments.index', compact('payments'));
    }

    // Form tambah pembayaran
    public function create()
    {
        return view('admin.payments.create');
    }

    // Simpan pembayaran baru
    public function store(Request $request)
    {
        $request->validate([
            'jamaah_id' => 'required',
            'amount' => 'required|numeric',
            'status' => 'required',
            'payment_date' => 'required|date',
        ]);

        Payment::create([
            'jamaah_id' => $request->jamaah_id,
            'amount' => $request->amount,
            'status' => $request->status,
            'payment_date' => $request->payment_date,
        ]);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    // Detail satu pembayaran
    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        return view('admin.payments.show', compact('payment'));
    }

    // Form edit
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        return view('admin.payments.edit', compact('payment'));
    }

    // Update pembayaran
    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'status' => 'required',
            'payment_date' => 'required|date',
        ]);

        $payment = Payment::findOrFail($id);

        $payment->update([
            'amount' => $request->amount,
            'status' => $request->status,
            'payment_date' => $request->payment_date,
        ]);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil diperbarui.');
    }

    // Hapus pembayaran
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }
}
