<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::latest();

        if ($request->has('search') && $request->search != null) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $users = $query->paginate(10)->withQueryString();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'in:admin,marketing,manager,jamaah'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $userToEdit  = $user;
        $currentUser = auth()->user();

        if ($currentUser->role === 'marketing' && $userToEdit->role !== 'jamaah') {
            if ($userToEdit->id !== $currentUser->id) {
                return back()->with('error', 'Akses Ditolak. Marketing hanya boleh mengedit data Jemaah.');
            }
        }

        if ($userToEdit->role === 'admin' && $userToEdit->id !== $currentUser->id) {
            return back()->with('error', 'Anda tidak dapat mengubah data sesama Admin demi keamanan.');
        }
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,marketing,manager,jamaah'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()]
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $userToDelete = $user;
        $currentUser  = auth()->user();

        if ($userToDelete->id === $currentUser->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri!');
        }

        if ($currentUser->role === 'marketing' && $userToDelete->role !== 'jamaah') {
            return back()->with('error', 'Akses Ditolak. Marketing hanya boleh menghapus data Jemaah.');
        }

        if ($userToDelete->role === 'admin') {
            return back()->with('error', 'Akun Admin dilindungi dan tidak dapat dihapus. Silakan hubungi IT Super Admin/Database Administrator.');
        }

        $userToDelete->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
