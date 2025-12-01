<?php

namespace App\Http\Controllers\Jamaah;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('package')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('jamaah.bookings.index', compact('bookings'));
    }

    public function store(Request $request, Package $package)
    {
        $user = Auth::user();

        if (!$user->jamaahProfile || empty($user->jamaahProfile->ktp_number)) {
            return redirect()->route('jamaah.profile.edit')
                ->with('error', 'Mohon lengkapi data profil Anda (No. KTP, dll) sebelum mendaftar paket.');
        }

        $existingBooking = Booking::where('user_id', $user->id)
            ->where('package_id', $package->id)
            ->where('status', '!=', 'rejected')
            ->exists();

        if ($existingBooking) {
            return back()->with('error', 'Anda sudah terdaftar di paket ini. Silakan cek menu "Pendaftaran Saya".');
        }

        $totalBooked = Booking::where('package_id', $package->id)
            ->where('status', '!=', 'rejected')
            ->count();

        if ($totalBooked >= $package->quota) {
            return back()->with('error', 'Mohon maaf, kuota untuk paket ini sudah penuh.');
        }

        DB::transaction(function () use ($user, $package) {
            Booking::create([
                'user_id'       => $user->id,
                'package_id'    => $package->id,
                'status'        => 'waiting',
                'total_price'   => $package->price,
            ]);
        });

        return redirect()->route('jamaah.bookings.index')
            ->with('success', 'Alhamdulillah, pendaftaran berhasil! Silakan lakukan pembayaran.');
    }

    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Akses tidak diizinkan.');
        }

        $booking->load(['package', 'payments']);

        return view('jamaah.bookings.show', compact('booking'));
    }
}
