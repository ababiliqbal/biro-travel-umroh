@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Payment</h1>

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Jamaah</label>
            <input type="text" name="nama_jamaah" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Bayar</label>
            <input type="date" name="tanggal_bayar" class="form-control" required>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
