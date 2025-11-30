@extends('layouts.app')

@section('content')
<h2>Detail Payment</h2>

<p><b>ID:</b> {{ $payment->id }}</p>
<p><b>Booking ID:</b> {{ $payment->booking_id }}</p>
<p><b>Amount:</b> {{ $payment->amount }}</p>
<p><b>Date:</b> {{ $payment->payment_date }}</p>
<p><b>Method:</b> {{ $payment->payment_method }}</p>
<p><b>Status:</b> {{ $payment->status }}</p>

<a href="{{ route('admin.payments.index') }}">Kembali</a>
@endsection
