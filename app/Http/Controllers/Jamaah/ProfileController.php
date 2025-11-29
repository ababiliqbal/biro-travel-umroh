<?php

namespace App\Http\Controllers\Jamaah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        $profile = $user->jamaahProfile;

        return view('jamaah.profile.edit', compact('user', 'profile'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number'    => ['required', 'string', 'max:20'],
            'ktp_number'      => ['required', 'string', 'max:20', Rule::unique('jamaah_profiles')->ignore($user->jamaahProfile->id ?? null)],
            'passport_number' => ['nullable', 'string', 'max:20', Rule::unique('jamaah_profiles')->ignore($user->jamaahProfile->id ?? null)],
            'date_of_birth'   => ['required', 'date'],
            'address'         => ['required', 'string'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->name = $request->name;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user->jamaahProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone_number'    => $request->phone_number,
                'ktp_number'      => $request->ktp_number,
                'passport_number' => $request->passport_number,
                'date_of_birth'   => $request->date_of_birth,
                'address'         => $request->address,
            ]
        );

        return redirect()->route('jamaah.profile.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
