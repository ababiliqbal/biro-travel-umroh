<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['booking.user', 'booking.package', 'verifier'])->paginate(10);

        return view('payments.index', compact('payments'));
    }
}

