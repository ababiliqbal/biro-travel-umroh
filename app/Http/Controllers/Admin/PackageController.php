<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Load semua packages beserta cover image path
        $packages = Package::latest()->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'price'       => 'required|numeric',
            'quota'       => 'required|numeric',
            'duration'    => 'required|numeric',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('cover_image');

        if ($request->hasFile('cover_image')) {
            $data['cover_image_path'] = $request->file('cover_image')->store('packages', 'public');
        }

        Package::create($data);

        return redirect()->route('admin.packages.index')
                         ->with('success', 'Package berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name'        => 'required|string',
            'price'       => 'required|numeric',
            'quota'       => 'required|numeric',
            'duration'    => 'required|numeric',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('cover_image');

        if ($request->hasFile('cover_image')) {
            // Hapus cover lama jika ada
            if ($package->cover_image_path && Storage::disk('public')->exists($package->cover_image_path)) {
                Storage::disk('public')->delete($package->cover_image_path);
            }

            // Simpan cover baru
            $data['cover_image_path'] = $request->file('cover_image')->store('packages', 'public');
        }

        $package->update($data);

        return redirect()->route('admin.packages.index')
                         ->with('success', 'Package berhasil diperbarui');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        // Pastikan cover image tersedia untuk view show
        return view('admin.packages.show', compact('package'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        // Hapus cover image jika ada
        if ($package->cover_image_path && Storage::disk('public')->exists($package->cover_image_path)) {
            Storage::disk('public')->delete($package->cover_image_path);
        }

        $package->delete();

        return redirect()->route('admin.packages.index')
                         ->with('success', 'Package berhasil dihapus');
    }
}
