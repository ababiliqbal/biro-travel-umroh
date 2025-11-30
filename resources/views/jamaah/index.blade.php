@extends('layouts.app')

@section('content')
<h2>Riwayat Pembayaran Anda</h2>

<table border="1" cellpadding="6" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Jumlah</th>
        <th>Tanggal</th>
        <th>Metode</th>
        <th>Status</th>
    </tr>

    @foreach ($payments as $p)
    <tr>
        <td>{{ $p->id }}</td>
        <td>{{ $p->amount }}</td>
        <td>{{ $p->payment_date }}</td>
        <td>{{ $p->payment_method }}</td>
        <td>{{ $p->status }}</td>
    </tr>
    @endforeach
</table>
@endsection
