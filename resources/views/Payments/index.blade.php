@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Payments</h1>
    <a href="{{ route('payments.create') }}" class="btn btn-primary mb-3">Tambah Payment</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Jamaah</th>
                <th>Jumlah</th>
                <th>Tanggal Bayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->nama_jamaah }}</td>
                <td>{{ number_format($payment->jumlah, 0, ',', '.') }}</td>
                <td>{{ $payment->tanggal_bayar }}</td>
                <td>
                    <a href="{{ route('payments.edit', $payment->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus payment ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
