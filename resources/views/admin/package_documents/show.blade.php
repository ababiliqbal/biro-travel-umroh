@extends('layouts.admin')

@section('title', 'Lihat Dokumen Paket')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6 text-primary">Lihat Dokumen Paket</h1>

    <div class="bg-white p-6 rounded-xl shadow">

        <div class="mb-4">
            <strong>Nama Paket:</strong> {{ $document->package ? $document->package->name : '-' }}
        </div>

        <div class="mb-4">
            <strong>Nama Dokumen:</strong> {{ $document->file_name }}
        </div>

        <div class="mb-4">
            <strong>Tipe Dokumen:</strong> {{ ucfirst($document->document_type) }}
        </div>

        <div class="mb-4">
            <strong>File Dokumen:</strong>
            @if($document->file_path && file_exists(storage_path('app/public/' . $document->file_path)))
                @php
                    $extension = strtolower(pathinfo($document->file_path, PATHINFO_EXTENSION));
                @endphp

                @if(in_array($extension, ['jpg','jpeg','png','gif']))
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $document->file_path) }}" 
                             alt="{{ $document->file_name }}" class="max-w-full rounded shadow">
                    </div>
                @elseif($extension === 'pdf')
                    <div class="mt-2">
                        <iframe src="{{ asset('storage/' . $document->file_path) }}" width="100%" height="600px" class="border rounded"></iframe>
                    </div>
                @else
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" class="text-blue-600 underline">
                            Download File
                        </a>
                    </div>
                @endif
            @else
                <p class="text-gray-500 mt-2">Tidak ada file tersedia.</p>
            @endif
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('admin.package-documents.index') }}" class="px-5 py-2 border rounded-lg hover:bg-gray-100">
                Kembali
            </a>
        </div>

    </div>
</div>
@endsection
