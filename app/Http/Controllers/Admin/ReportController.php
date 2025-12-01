<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function finance(Request $request)
    {
        $startDate = $request->input('start_date') ? Carbon::parse($request->start_date) : Carbon::now()->startOfMonth();
        $endDate   = $request->input('end_date')   ? Carbon::parse($request->end_date)   : Carbon::now()->endOfMonth();

        $query = Payment::with(['booking.user', 'booking.package'])
            ->where('status', 'verified')
            ->whereBetween('payment_date', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')]);

        $totalIncome = (clone $query)->sum('amount');
        $totalTransactions = (clone $query)->count();

        $payments = $query->latest('payment_date')->paginate(15)->withQueryString();

        return view('admin.reports.finance', compact(
            'payments',
            'totalIncome',
            'totalTransactions',
            'startDate',
            'endDate'
        ));
    }

    public function statistics()
    {
        $packages = Package::withCount(['bookings' => function ($query) {
            $query->where('status', '!=', 'rejected');
        }])
            ->withSum(['bookings' => function ($query) {
                $query->where('status', '!=', 'rejected');
            }], 'total_price')
            ->get();

        $packages->each(function ($package) {
            $package->occupancy_rate = ($package->quota > 0)
                ? round(($package->bookings_count / $package->quota) * 100)
                : 0;
        });

        $topPackage = $packages->sortByDesc('bookings_count')->first();

        $lowPackage = $packages->sortBy('bookings_count')->first();

        $totalPendaftarAll = $packages->sum('bookings_count');

        return view('admin.reports.statistics', compact(
            'packages',
            'topPackage',
            'lowPackage',
            'totalPendaftarAll'
        ));
    }

    public function latePayments()
    {
        $lateBookings = Booking::with(['user', 'package', 'payments'])
            ->where('status', 'waiting')
            ->whereDate('due_date', '<', now())
            ->orderBy('due_date', 'asc')
            ->get();

        $lateBookings->transform(function ($booking) {
            $paid = $booking->payments->where('status', 'verified')->sum('amount');
            $booking->debt = $booking->total_price - $paid;

            $booking->days_overdue = (int) $booking->due_date->diffInDays(now());

            return $booking;
        });

        return view('admin.reports.late_payments', compact('lateBookings'));
    }
}
