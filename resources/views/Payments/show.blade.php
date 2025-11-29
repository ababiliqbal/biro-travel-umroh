@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Payment</h1>

    <div class="card p-4">
        <div class="mb-3">
            <strong>Nama Jamaah:</strong>
            <p>{{ $payment->nama_jamaah }}</p>
        </div>

        <div class="mb-3">
            <strong>Jumlah Pembayaran:</strong>
            <p>Rp {{ number_format($payment->jumlah, 0, ',', '.') }}</p>
        </div>

        <div class="mb-3">
            <strong>Tanggal Bayar:</strong>
            <p>{{ $payment->tanggal_bayar }}</p>
        </div>

        <div class="mt-3">
            <a href="{{ route('payments.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning">Edit</a>

            <form action="{{ route('payments.destroy', $payment->id) }}" 
                  method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="return confirm('Hapus data ini?')">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
