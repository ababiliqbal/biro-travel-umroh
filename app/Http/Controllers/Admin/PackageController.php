<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Package::latest();

        if ($request->has('search') && $request->search != null) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('facilities', 'like', "%$search%");
            });
        }
        $packages = $query->paginate(10)->withQueryString();
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
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'cover_image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description'      => 'nullable|string',
            'price'            => 'required|integer|min:0',
            'quota'            => 'required|integer|min:1',
            'departure_date'   => 'required|date',
            'facilities'       => 'nullable|string',
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('packages', 'public');
            $data['cover_image_path'] = $path;
        }

        Package::create($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket umroh berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        //
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
        $data = $request->validate([
            'name'             => 'required|string|max:255',
            'cover_image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description'      => 'nullable|string',
            'price'            => 'required|integer|min:0',
            'quota'            => 'required|integer|min:1',
            'departure_date'   => 'required|date',
            'facilities'       => 'nullable|string',
        ]);

        if ($request->hasFile('cover_image')) {

            if ($package->cover_image_path && Storage::disk('public')->exists($package->cover_image_path)) {
                Storage::disk('public')->delete($package->cover_image_path);
            }

            $path = $request->file('cover_image')->store('packages', 'public');
            $data['cover_image_path'] = $path;
        }

        $package->update($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket umroh berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        foreach ($package->documents as $document) {
            if (Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
        }

        if ($package->cover_image_path && Storage::disk('public')->exists($package->cover_image_path)) {
            Storage::disk('public')->delete($package->cover_image_path);
        }

        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket umroh dan dokumen pendukung berhasil dihapus.');
    }
}
