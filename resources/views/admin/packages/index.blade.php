@extends('layouts.admin')

@section('title', 'Manajemen Paket Umroh')

@section('content')

    <div class="max-w-7xl mx-auto">

        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl font-serif">Katalog Paket Umroh</h1>
                <p class="mt-2 text-sm text-gray-700">Kelola informasi paket perjalanan, harga, dan ketersediaan kuota.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.packages.create') }}"
                    class="inline-flex items-center justify-center rounded-md bg-accent px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-yellow-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent transition-all duration-200">
                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path
                            d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                    </svg>
                    Buat Paket Baru
                </a>
            </div>
        </div>

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="mb-6 rounded-md bg-green-50 p-4 border border-green-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button @click="show = false"
                            class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none">
                            <span class="sr-only">Dismiss</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

            <div
                class="p-5 border-b border-gray-100 bg-white flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <form action="{{ route('admin.packages.index') }}" method="GET" class="relative w-full max-w-sm">
                    <label for="search" class="sr-only">Cari paket</label>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        class="block w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition duration-150 ease-in-out"
                        placeholder="Cari nama paket...">
                </form>
            </div>

            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Info Paket</th>
                            <th scope="col"
                                class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Harga</th>
                            <th scope="col"
                                class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Kuota</th>
                            <th scope="col"
                                class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Keberangkatan</th>
                            <th scope="col"
                                class="px-6 py-3.5 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($packages as $package)
                            <tr class="hover:bg-gray-50 transition-colors duration-150 group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="h-16 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200 bg-gray-100">
                                            @if ($package->cover_image_path)
                                                <img src="{{ Storage::url($package->cover_image_path) }}"
                                                    alt="{{ $package->name }}"
                                                    class="h-full w-full object-cover object-center">
                                            @else
                                                <div class="flex h-full items-center justify-center text-gray-400">
                                                    <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div
                                                class="text-sm font-bold text-gray-900 group-hover:text-primary transition-colors">
                                                {{ $package->name }}</div>
                                            <div class="text-xs text-gray-500 mt-0.5">ID: #{{ $package->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900">Rp
                                        {{ number_format($package->price, 0, ',', '.') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                        {{ $package->quota }} Pax
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $package->departure_date->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end items-center gap-2">

                                        <a href="{{ route('admin.packages.documents.index', $package->id) }}"
                                            class="p-1 rounded-full text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-colors duration-200"
                                            title="Kelola Dokumen">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                            </svg>
                                        </a>

                                        <a href="{{ route('admin.packages.edit', $package->id) }}"
                                            class="p-1 rounded-full text-gray-400 hover:text-accent hover:bg-yellow-50 transition-colors duration-200"
                                            title="Edit Paket">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Hapus paket ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-1 rounded-full text-gray-400 hover:text-red-600 hover:bg-red-50 transition-colors duration-200"
                                                title="Hapus Paket">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-semibold text-gray-900">Belum ada paket umroh</h3>
                                        <p class="mt-1 text-sm text-gray-500">Mulai tambahkan paket perjalanan untuk jemaah
                                            Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="md:hidden">
                <div class="grid grid-cols-1 gap-4 p-4 bg-gray-50">
                    @forelse($packages as $package)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden flex flex-col">
                            <div class="relative h-40 w-full bg-gray-100">
                                @if ($package->cover_image_path)
                                    <img src="{{ Storage::url($package->cover_image_path) }}" alt="{{ $package->name }}"
                                        class="h-full w-full object-cover">
                                @else
                                    <div class="flex h-full items-center justify-center text-gray-400">
                                        <svg class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute top-2 right-2">
                                    <span
                                        class="inline-flex items-center rounded-md bg-white/90 backdrop-blur px-2 py-1 text-xs font-bold text-gray-800 shadow-sm">
                                        {{ $package->quota }} Kursi
                                    </span>
                                </div>
                            </div>

                            <div class="p-4 flex flex-col flex-1">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-base font-bold text-gray-900 leading-tight">{{ $package->name }}</h3>
                                </div>
                                <p class="text-sm font-medium text-primary mb-3">Rp
                                    {{ number_format($package->price, 0, ',', '.') }}</p>

                                <div class="mt-auto pt-3 border-t border-gray-100 flex items-center justify-between">
                                    <div class="text-xs text-gray-500 flex items-center">
                                        <svg class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $package->departure_date->format('d M Y') }}
                                    </div>
                                    <div class="flex gap-4 items-center"> <a
                                            href="{{ route('admin.packages.documents.index', $package->id) }}"
                                            class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                            </svg>
                                            Dokumen
                                        </a>

                                        <a href="{{ route('admin.packages.edit', $package->id) }}"
                                            class="text-sm font-medium text-gray-500 hover:text-accent transition-colors">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Hapus?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="text-sm font-medium text-red-500 hover:text-red-700 transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 px-4 bg-white rounded-lg border border-dashed border-gray-300">
                            <p class="text-sm text-gray-500">Belum ada paket umroh.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            @if ($packages->hasPages())
                <div class="px-5 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $packages->links() }}
                </div>
            @endif

        </div>
    </div>

@endsection
