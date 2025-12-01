@extends('layouts.public')

@section('title', $package->name)

@section('content')

    <div class="bg-primary/5 py-8 border-b border-primary/10">
        <div class="container mx-auto px-4 lg:px-8">
            <nav class="flex text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li><a href="{{ route('home') }}" class="hover:text-primary">Beranda</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li><a href="{{ route('packages.catalog') }}" class="hover:text-primary">Paket Umroh</a></li>
                    <li><span class="mx-2">/</span></li>
                    <li class="text-primary font-medium truncate max-w-[200px] md:max-w-none">{{ $package->name }}</li>
                </ol>
            </nav>

            <h1 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-dark mb-4">
                {{ $package->name }}
            </h1>
            <div class="flex flex-wrap items-center gap-4 text-sm md:text-base text-gray-600">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>Keberangkatan: <strong>{{ $package->departure_location }}</strong></span>
                </div>
                <div class="hidden md:block w-1 h-1 bg-gray-400 rounded-full"></div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span>Tanggal: <strong>{{ $package->departure_date->format('d F Y') }}</strong></span>
                </div>
            </div>
        </div>
    </div>

    <section class="py-12 bg-base">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">

                <div class="lg:col-span-2 space-y-10">

                    <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-100 group">
                        @if ($package->cover_image_path)
                            <img src="{{ Storage::url($package->cover_image_path) }}" alt="{{ $package->name }}"
                                class="w-full h-auto object-cover transform group-hover:scale-105 transition duration-700">
                        @else
                            <div class="w-full h-96 bg-gray-200 flex items-center justify-center text-gray-400">
                                <span class="text-lg">Tidak ada gambar</span>
                            </div>
                        @endif
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-2xl font-serif font-bold text-primary mb-6 flex items-center gap-3">
                            <span class="w-8 h-1 bg-accent rounded-full"></span>
                            Deskripsi Paket
                        </h2>
                        <div class="prose prose-lg text-gray-600 max-w-none leading-relaxed">
                            {!! nl2br(e($package->description)) !!}
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-2xl font-serif font-bold text-primary mb-6 flex items-center gap-3">
                            <span class="w-8 h-1 bg-accent rounded-full"></span>
                            Fasilitas Termasuk
                        </h2>
                        <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach (explode("\n", $package->facilities) as $facility)
                                @if (trim($facility) != '')
                                    <li
                                        class="flex items-start gap-3 p-3 rounded-lg bg-base border border-transparent hover:border-primary/20 transition">
                                        <div
                                            class="w-6 h-6 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                                            <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span class="text-dark">{{ trim($facility) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    @if ($package->documents->count() > 0)
                        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                            <h2 class="text-2xl font-serif font-bold text-primary mb-6 flex items-center gap-3">
                                <span class="w-8 h-1 bg-accent rounded-full"></span>
                                Unduh Informasi
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($package->documents as $doc)
                                    <a href="{{ Storage::url($doc->file_path) }}" target="_blank"
                                        class="flex items-center gap-4 p-4 rounded-xl border border-gray-200 hover:border-primary hover:shadow-md transition group">
                                        <div
                                            class="w-12 h-12 bg-red-50 text-red-500 rounded-lg flex items-center justify-center group-hover:bg-primary group-hover:text-white transition">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-dark group-hover:text-primary transition">
                                                {{ $doc->file_name }}</p>
                                            <p class="text-xs text-gray-500 uppercase tracking-wide">
                                                {{ $doc->document_type }}</p>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-300 ml-auto group-hover:text-primary" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                <div class="lg:col-span-1">
                    <div class="lg:sticky lg:top-24 space-y-6">

                        <div class="bg-white p-6 rounded-2xl shadow-xl border border-gray-100 relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-primary to-accent"></div>

                            <p class="text-sm text-gray-500 mb-1">Harga mulai dari</p>
                            <div class="flex items-baseline gap-1 mb-6">
                                <span class="text-sm font-bold text-primary">Rp</span>
                                <span
                                    class="text-4xl font-bold text-primary">{{ number_format($package->price, 0, ',', '.') }}</span>
                            </div>

                            <hr class="border-dashed border-gray-200 mb-6">

                            <div class="space-y-4 mb-8">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Sisa Kuota</span>
                                    @if ($package->quota > 0)
                                        <span
                                            class="font-bold text-green-600 bg-green-50 px-2 py-0.5 rounded">{{ $package->quota }}
                                            Orang</span>
                                    @else
                                        <span class="font-bold text-red-600 bg-red-50 px-2 py-0.5 rounded">Habis</span>
                                    @endif
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Keberangkatan</span>
                                    <span
                                        class="font-medium text-dark">{{ $package->departure_date->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Durasi</span>
                                    <span class="font-medium text-dark">9-12 Hari</span>
                                </div>
                            </div>

                            @if ($package->quota > 0)
                                @auth
                                    @if (Auth::user()->role === 'jamaah')
                                        <form action="{{ route('jamaah.booking.store', $package->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                onclick="return confirm('Apakah Anda yakin ingin mendaftar paket ini?')"
                                                class="w-full py-4 bg-accent text-white font-bold rounded-xl shadow-lg hover:bg-yellow-600 hover:shadow-xl transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                                <span>Daftar Sekarang</span>
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                                </svg>
                                            </button>
                                        </form>
                                        <p class="text-xs text-center text-gray-400 mt-3">Lanjutkan ke proses pendaftaran</p>
                                    @else
                                        <button disabled
                                            class="w-full py-4 bg-gray-300 text-gray-500 font-bold rounded-xl cursor-not-allowed">
                                            Login sebagai Staf
                                        </button>
                                        <p class="text-xs text-center text-gray-400 mt-3">Staf tidak dapat mendaftar paket
                                            sendiri.</p>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                        class="w-full block text-center py-4 bg-primary text-white font-bold rounded-xl shadow-lg hover:bg-primary-dark transition">
                                        Login untuk Mendaftar
                                    </a>
                                    <p class="text-xs text-center text-gray-400 mt-3">Anda harus memiliki akun Jemaah.</p>
                                @endauth
                            @else
                                <button disabled
                                    class="w-full py-4 bg-gray-200 text-gray-400 font-bold rounded-xl cursor-not-allowed">
                                    Kuota Penuh
                                </button>
                            @endif

                        </div>

                        <div class="bg-primary/5 p-6 rounded-2xl border border-primary/10 text-center">
                            <p class="text-sm font-medium text-dark mb-3">Butuh bantuan tentang paket ini?</p>
                            <a href="https://wa.me/6281234567890?text=Assalamualaikum,%20saya%20tertarik%20dengan%20paket%20{{ urlencode($package->name) }}"
                                target="_blank"
                                class="inline-flex items-center gap-2 text-primary font-bold hover:underline">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                </svg>
                                Hubungi via WhatsApp
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
