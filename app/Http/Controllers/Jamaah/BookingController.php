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

    public function store(Request $request, $packageId)
    {
        $user = Auth::user();

        if (!$user->jamaahProfile || empty($user->jamaahProfile->ktp_number)) {
            return redirect()->route('jamaah.profile.edit')
                ->with('error', 'Mohon lengkapi data profil Anda (No. KTP, Paspor, Alamat) sebelum mendaftar paket.');
        }

        try {
            DB::transaction(function () use ($user, $packageId) {

                $package = Package::where('id', $packageId)->lockForUpdate()->firstOrFail();

                $existingBooking = Booking::where('user_id', $user->id)
                    ->where('package_id', $package->id)
                    ->where('status', '!=', 'rejected')
                    ->exists();

                if ($existingBooking) {
                    throw new \Exception('Anda sudah terdaftar di paket ini. Silakan cek menu "Pendaftaran Saya".');
                }


                $currentBookingsCount = Booking::where('package_id', $package->id)
                    ->where('status', '!=', 'rejected')
                    ->count();

                if ($currentBookingsCount >= $package->quota) {
                    throw new \Exception('Mohon maaf, kuota untuk paket ini baru saja habis terjual.');
                }

                $dueDate = $package->departure_date->copy()->subDays($package->payment_due_days);
                Booking::create([
                    'user_id'       => $user->id,
                    'package_id'    => $package->id,
                    'status'        => 'waiting',
                    'total_price'   => $package->price,
                    'due_date'      => $dueDate,
                ]);
            });


            return redirect()->route('jamaah.bookings.index')
                ->with('success', 'Alhamdulillah, kursi berhasil diamankan! Silakan segera lakukan pembayaran.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
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
