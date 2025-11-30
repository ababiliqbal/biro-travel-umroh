<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\PackageDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageDocumentController extends Controller
{
    public function index(Package $package)
    {
        $documents = $package->documents()->latest()->get();
        return view('admin.package_documents.index', compact('package', 'documents'));
    }

    public function store(Request $request, Package $package)
    {
        $request->validate([
            'file_name'     => 'required|string|max:255',
            'document_type' => 'required|in:visa,ticket,hotel,itinerary,other',
            'file'          => 'required|file|mimes:pdf,doc,docx,jpg,png|max:5120', // Max 5MB
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('package_documents', 'public');

            $package->documents()->create([
                'file_name'     => $request->file_name,
                'document_type' => $request->document_type,
                'file_path'     => $path,
            ]);
        }

        return back()->with('success', 'Dokumen berhasil diunggah.');
    }

    public function destroy(PackageDocument $document)
    {
        if (Storage::disk('public')->exists($document->file_path)) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return back()->with('success', 'Dokumen berhasil dihapus.');
    }
}
