@extends('layouts.app')

@section('content')
<h2>Tambah Payment</h2>

<form action="{{ route('admin.payments.store') }}" method="POST">
    @csrf

    <label>Booking</label>
    <select name="booking_id">
        @foreach($bookings as $b)
            <option value="{{ $b->id }}">{{ $b->id }}</option>
        @endforeach
    </select>
    <br><br>

    <label>Amount</label>
    <input type="number" name="amount">
    <br><br>

    <label>Tanggal Pembayaran</label>
    <input type="date" name="payment_date">
    <br><br>

    <label>Metode</label>
    <select name="payment_method">
        <option value="transfer">Transfer</option>
        <option value="cash">Cash</option>
    </select>
    <br><br>

    <label>Status</label>
    <select name="status">
        <option value="pending">Pending</option>
        <option value="verified">Verified</option>
    </select>
    <br><br>

    <button type="submit">SIMPAN</button>
</form>
@endsection
