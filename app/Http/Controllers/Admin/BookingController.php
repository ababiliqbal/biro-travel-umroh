<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'package'])->latest();

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        $bookings = $query->paginate(10)->withQueryString();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $users = User::where('role', 'jamaah')->orderBy('name')->get();

        $packages = Package::where('quota', '>', 0)
            ->where('departure_date', '>', now())
            ->orderBy('departure_date')
            ->get();

        return view('admin.bookings.create', compact('users', 'packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'    => 'required|exists:users,id',
            'package_id' => 'required|exists:packages,id',
        ]);

        $package = Package::findOrFail($request->package_id);

        $currentBookings = Booking::where('package_id', $package->id)
            ->where('status', '!=', 'rejected')
            ->count();

        if ($currentBookings >= $package->quota) {
            return back()->with('error', 'Gagal! Kuota paket ini sudah penuh.')->withInput();
        }

        $exists = Booking::where('user_id', $request->user_id)
            ->where('package_id', $request->package_id)
            ->where('status', '!=', 'rejected')
            ->exists();

        if ($exists) {
            return back()->with('error', 'Jemaah ini sudah terdaftar di paket tersebut.')->withInput();
        }

        $dueDate = $package->departure_date->copy()->subDays($package->payment_due_days);

        $booking = Booking::create([
            'user_id'       => $request->user_id,
            'package_id'    => $package->id,
            'registered_by' => auth()->id(),
            'status'        => 'waiting',
            'total_price'   => $package->price,
            'due_date'      => $dueDate,
        ]);

        return redirect()->route('admin.bookings.show', $booking->id)
            ->with('success', 'Pendaftaran manual berhasil dibuat.');
    }

    public function show(Booking $booking)
    {
        $booking->load(['user.jamaahProfile', 'package', 'payments']);

        return view('admin.bookings.show', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:waiting,approved,departed,completed,rejected'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return back()->with('success', "Status pendaftaran berhasil diperbarui menjadi '" . ucfirst($request->status) . "'.");
    }
}
