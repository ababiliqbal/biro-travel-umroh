@extends('layouts.admin')

@section('title', 'Dokumen Paket')

@section('content')

    <div class="max-w-7xl mx-auto">

        <div class="mb-8">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li>
                        <a href="{{ route('admin.packages.index') }}"
                            class="text-gray-500 hover:text-primary transition-colors text-sm font-medium flex items-center group">
                            <svg class="flex-shrink-0 h-4 w-4 mr-2 text-gray-400 group-hover:text-primary"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Katalog Paket
                        </a>
                    </li>
                    <li><span class="text-gray-400">/</span></li>
                    <li class="text-sm font-medium text-gray-900" aria-current="page">Kelola Dokumen</li>
                </ol>
            </nav>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-primary sm:text-3xl sm:truncate font-serif">
                        Dokumen Paket: <span class="text-gray-900">{{ $package->name }}</span>
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Upload dan kelola dokumen pendukung perjalanan (Itinerary, Visa, Tiket, dll).
                    </p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show"
                class="mb-6 rounded-md bg-green-50 p-4 border border-green-200 flex justify-between items-center">
                <div class="flex">
                    <svg class="h-5 w-5 text-green-400 mr-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-green-500 hover:text-green-700"><svg class="h-5 w-5"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                    </svg></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-md bg-red-50 p-4 border border-red-200">
                <div class="flex">
                    <svg class="h-5 w-5 text-red-400 mr-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada upload dokumen</h3>
                        <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-white">
                        <h3 class="text-base font-semibold leading-6 text-gray-900">Arsip Dokumen</h3>
                        <span
                            class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">
                            {{ $documents->count() }} File
                        </span>
                    </div>

                    <ul role="list" class="divide-y divide-gray-100">
                        @forelse($documents as $doc)
                            <li
                                class="flex items-center justify-between gap-x-6 py-5 px-6 hover:bg-gray-50 transition-colors group">
                                <div class="flex min-w-0 gap-x-4">
                                    <div
                                        class="h-12 w-12 flex-none rounded-lg bg-primary/10 flex items-center justify-center">
                                        <svg class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0 flex-auto">
                                        <p
                                            class="text-sm font-semibold leading-6 text-gray-900 group-hover:text-primary transition-colors">
                                            {{ $doc->file_name }}</p>
                                        <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                                            @php
                                                $badges = [
                                                    'visa' => 'text-purple-700 bg-purple-50 ring-purple-600/20',
                                                    'ticket' => 'text-blue-700 bg-blue-50 ring-blue-600/20',
                                                    'hotel' => 'text-orange-700 bg-orange-50 ring-orange-600/20',
                                                    'itinerary' => 'text-green-700 bg-green-50 ring-green-600/20',
                                                    'other' => 'text-gray-600 bg-gray-50 ring-gray-500/10',
                                                ];
                                                $class = $badges[$doc->document_type] ?? $badges['other'];
                                            @endphp
                                            <span
                                                class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $class }} uppercase tracking-wider">{{ $doc->document_type }}</span>
                                            <span class="truncate">&bull; Uploaded
                                                {{ $doc->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-none items-center gap-x-4">
                                    <a href="{{ Storage::url($doc->file_path) }}" target="_blank"
                                        class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block">Lihat</a>

                                    <form action="{{ route('admin.documents.destroy', $doc->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus dokumen ini secara permanen?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="rounded-md p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors">
                                            <span class="sr-only">Hapus</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @empty
                            <li class="px-6 py-12 text-center">
                                <div class="mx-auto h-24 w-24 text-gray-200">
                                    <svg class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776" />
                                    </svg>
                                </div>
                                <h3 class="mt-2 text-sm font-semibold text-gray-900">Belum ada dokumen</h3>
                                <p class="mt-1 text-sm text-gray-500">Upload dokumen pendukung untuk paket ini di kolom
                                    sebelah kanan.</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-1 lg:sticky lg:top-24">
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-primary text-white">
                        <h3 class="font-bold text-lg">Upload Baru</h3>
                        <p class="text-xs text-primary-100 opacity-90">Tambahkan file pendukung paket.</p>
                    </div>

                    <div class="p-6">
                        <form action="{{ route('admin.packages.documents.store', $package->id) }}" method="POST"
                            enctype="multipart/form-data" x-data="{ fileName: null }">
                            @csrf

                            <div class="space-y-5">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Dokumen</label>
                                    <input type="text" name="file_name" required
                                        placeholder="Contoh: Jadwal Perjalanan"
                                        class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori Dokumen</label>
                                    <select name="document_type" required
                                        class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                                        <option value="" disabled selected>Pilih Kategori...</option>
                                        <option value="itinerary">📅 Itinerary (Jadwal)</option>
                                        <option value="visa">🛂 Visa / Izin Masuk</option>
                                        <option value="ticket">✈️ Tiket Pesawat</option>
                                        <option value="hotel">🏨 Voucher Hotel</option>
                                        <option value="other">📄 Lainnya</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih File</label>

                                    <div class="mt-2 flex justify-center rounded-lg border border-dashed px-6 py-6 transition-all duration-200 relative"
                                        :class="fileName ? 'border-primary bg-primary/5' : 'border-gray-900/25 hover:bg-gray-50'">

                                        <div class="text-center" x-show="!fileName">
                                            <svg class="mx-auto h-8 w-8 text-gray-300" viewBox="0 0 24 24"
                                                fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <div class="mt-2 flex text-xs leading-6 text-gray-600 justify-center">
                                                <label for="file-upload"
                                                    class="relative cursor-pointer rounded-md bg-transparent font-semibold text-primary focus-within:outline-none hover:text-primary-hover">
                                                    <span>Upload file</span>
                                                    <input id="file-upload" name="file" type="file"
                                                        class="sr-only" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                                        @change="fileName = $event.target.files[0].name">
                                                </label>
                                            </div>
                                            <p class="text-xs leading-5 text-gray-500">PDF, JPG, DOC up to 5MB</p>
                                        </div>

                                        <div class="text-center w-full" x-show="fileName" x-cloak>
                                            <div class="flex items-center justify-center mb-2 text-primary">
                                                <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </div>
                                            <p class="text-sm font-bold text-gray-900 truncate px-2" x-text="fileName">
                                            </p>
                                            <p class="text-xs text-green-600 font-medium mt-1">File siap diupload</p>

                                            <div class="mt-3">
                                                <label for="file-upload"
                                                    class="cursor-pointer text-xs font-semibold text-red-500 hover:text-red-700 hover:underline">
                                                    Ganti File
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <button type="submit"
                                    class="flex w-full justify-center rounded-md bg-accent px-3 py-2 text-sm font-bold text-white shadow-sm hover:bg-yellow-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent transition-all duration-200">
                                    Simpan Dokumen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
