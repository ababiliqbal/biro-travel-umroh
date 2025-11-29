@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Payment</h1>

    <form action="{{ route('payments.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Jamaah</label>
            <input type="text" name="nama_jamaah" class="form-control"
                   value="{{ $payment->nama_jamaah }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control"
                   value="{{ $payment->jumlah }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Bayar</label>
            <input type="date" name="tanggal_bayar" class="form-control"
                   value="{{ $payment->tanggal_bayar }}" required>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
