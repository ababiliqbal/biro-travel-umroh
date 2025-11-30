@extends('layouts.app')

@section('content')
<h2>Data Payments</h2>

<a href="{{ route('admin.payments.create') }}">+ Tambah Payment</a>

<table border="1" cellpadding="6" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Booking ID</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach ($payments as $p)
    <tr>
        <td>{{ $p->id }}</td>
        <td>{{ $p->booking_id }}</td>
        <td>{{ $p->amount }}</td>
        <td>{{ $p->status }}</td>

        <td>
            <a href="{{ route('admin.payments.show', $p->id) }}">Detail</a> |
            <a href="{{ route('admin.payments.edit', $p->id) }}">Edit</a> |
            <form action="{{ route('admin.payments.destroy', $p->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
