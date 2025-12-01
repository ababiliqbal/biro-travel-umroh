<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $totalJamaah = User::where('role', 'jamaah')->count();

        $newBookingsThisMonth = Booking::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $pendingPayments = Payment::where('status', 'pending')->count();

        $incomeThisMonth = Payment::where('status', 'verified')
            ->whereMonth('payment_date', Carbon::now()->month)
            ->whereYear('payment_date', Carbon::now()->year)
            ->sum('amount');

        $recentBookings = Booking::with(['user', 'package'])
            ->latest()
            ->take(5)
            ->get();

        $recentPayments = Payment::with(['booking.user'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalJamaah',
            'newBookingsThisMonth',
            'pendingPayments',
            'incomeThisMonth',
            'recentBookings',
            'recentPayments'
        ));
    }
}
