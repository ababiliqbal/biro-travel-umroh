<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'package_id' => 'required|integer',
            'registered_by' => 'nullable|integer',
            'status' => 'required|string|max:50',
            'total_price' => 'required|integer',
        ]);

        Booking::create($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'package_id' => 'required|integer',
            'registered_by' => 'nullable|integer',
            'status' => 'required|string|max:50',
            'total_price' => 'required|integer',
        ]);

        $booking->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
