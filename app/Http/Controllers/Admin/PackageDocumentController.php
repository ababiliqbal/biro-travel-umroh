<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageDocumentController extends Controller
{
    // List dokumen
    public function index()
    {
        $documents = PackageDocument::with('package')->latest()->paginate(10);
        return view('admin.package_documents.index', compact('documents'));
    }

    // Form create
    public function create()
    {
        $packages = Package::all();
        return view('admin.package_documents.create', compact('packages'));
    }

    // Store dokumen baru
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'file_name' => 'required|string',
            'document_file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'document_type' => 'required|in:brochure,itinerary,visa,photo,other',
        ]);

        $filePath = $request->file('document_file')->store('package_documents', 'public');

        PackageDocument::create([
            'package_id' => $request->package_id,
            'file_name' => $request->file_name,
            'file_path' => $filePath,
            'document_type' => $request->document_type,
        ]);

        return redirect()->route('admin.package-documents.index')
                         ->with('success', 'Dokumen berhasil ditambahkan');
    }

    // Show dokumen
    public function show(PackageDocument $package_document)
    {
        $package_document->load('package');

        // Cek tipe file
        $fileUrl = $package_document->file_path ? asset('storage/' . $package_document->file_path) : null;

        return view('admin.package_documents.show', [
            'document' => $package_document,
            'fileUrl' => $fileUrl,
        ]);
    }

    // Form edit dokumen
    public function edit(PackageDocument $package_document)
    {
        $packages = Package::all();
        return view('admin.package_documents.edit', [
            'document' => $package_document,
            'packages' => $packages
        ]);
    }

    // Update dokumen
    public function update(Request $request, PackageDocument $package_document)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'file_name' => 'required|string',
            'document_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'document_type' => 'required|in:brochure,itinerary,visa,photo,other',
        ]);

        $data = $request->only('package_id', 'file_name', 'document_type');

        if ($request->hasFile('document_file')) {
            // hapus file lama
            if ($package_document->file_path && Storage::disk('public')->exists($package_document->file_path)) {
                Storage::disk('public')->delete($package_document->file_path);
            }
            $data['file_path'] = $request->file('document_file')->store('package_documents', 'public');
        }

        $package_document->update($data);

        return redirect()->route('admin.package-documents.index')
                         ->with('success', 'Dokumen berhasil diperbarui');
    }

    // Hapus dokumen
    public function destroy(PackageDocument $package_document)
    {
        // hapus file dulu
        if ($package_document->file_path && Storage::disk('public')->exists($package_document->file_path)) {
            Storage::disk('public')->delete($package_document->file_path);
        }
        $package_document->delete();

        return back()->with('success', 'Dokumen berhasil dihapus');
    }
}
