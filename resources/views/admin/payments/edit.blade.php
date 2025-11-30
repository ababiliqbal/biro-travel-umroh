@extends('layouts.app')

@section('content')
<h2>Edit Payment</h2>

<form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Booking</label>
    <select name="booking_id">
        @foreach($bookings as $b)
            <option value="{{ $b->id }}" {{ $b->id == $payment->booking_id ? 'selected' : '' }}>
                {{ $b->id }}
            </option>
        @endforeach
    </select>
    <br><br>

    <label>Amount</label>
    <input type="number" name="amount" value="{{ $payment->amount }}">
    <br><br>

    <label>Tanggal Pembayaran</label>
    <input type="date" name="payment_date" value="{{ $payment->payment_date }}">
    <br><br>

    <label>Metode</label>
    <select name="payment_method">
        <option value="transfer" {{ $payment->payment_method == 'transfer' ? 'selected' : '' }}>Transfer</option>
        <option value="cash" {{ $payment->payment_method == 'cash' ? 'selected' : '' }}>Cash</option>
    </select>
    <br><br>

    <label>Status</label>
    <select name="status">
        <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="verified" {{ $payment->status == 'verified' ? 'selected' : '' }}>Verified</option>
    </select>
    <br><br>

    <button type="submit">UPDATE</button>
</form>
@endsection
