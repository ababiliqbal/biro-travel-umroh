@extends('layouts.admin')

@section('title', 'Edit Dokumen Paket')

@section('content')
<div class="max-w-4xl mx-auto">

    <h1 class="text-2xl font-bold mb-6 text-primary">Edit Dokumen Paket</h1>

    {{-- Alert error --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
            <ul class="list-disc pl-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.package-documents.update', $document) }}" method="POST" 
          enctype="multipart/form-data"
          class="bg-white p-6 rounded-xl shadow">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-5">

            <div>
                <label class="block font-medium mb-1">Pilih Paket</label>
                <select name="package_id" class="w-full border rounded-lg p-2" required>
                    @foreach($packages as $package)
                        <option value="{{ $package->id }}" 
                                {{ $document->package_id == $package->id ? 'selected' : '' }}>
                            {{ $package->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Nama Dokumen</label>
                <input type="text" name="file_name" class="w-full border rounded-lg p-2"
                       value="{{ old('file_name', $document->file_name) }}" required>
            </div>

            <div>
                <label class="block font-medium mb-1">Tipe Dokumen</label>
                <select name="document_type" class="w-full border rounded-lg p-2" required>
                    <option value="brochure"   {{ $document->document_type == 'brochure' ? 'selected' : '' }}>Brochure</option>
                    <option value="itinerary"  {{ $document->document_type == 'itinerary' ? 'selected' : '' }}>Itinerary</option>
                    <option value="visa"       {{ $document->document_type == 'visa' ? 'selected' : '' }}>Visa</option>
                    <option value="photo"      {{ $document->document_type == 'photo' ? 'selected' : '' }}>Photo</option>
                    <option value="other"      {{ $document->document_type == 'other' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <div>
                <label class="block font-medium mb-1">Upload File Baru (opsional)</label>
                <input type="file" name="document_file" class="w-full border rounded-lg p-2" accept=".pdf,.jpg,.jpeg,.png">
                @if($document->file_path)
                    <p class="text-sm mt-1">File saat ini: 
                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="text-blue-600 underline">
                            {{ $document->file_name }}
                        </a>
                    </p>
                @endif
            </div>

        </div>

        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ route('admin.package-documents.index') }}" class="px-5 py-2 border rounded-lg hover:bg-gray-100">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-dark transition">
                Simpan Perubahan
            </button>
        </div>

    </form>
</div>
@endsection
