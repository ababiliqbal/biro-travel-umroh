@extends('layouts.public')

@section('title', 'Wujudkan Niat Suci Anda')

@section('content')

    <section class="relative h-screen min-h-[600px] flex items-center justify-center bg-dark overflow-hidden">

        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1565552629477-ff728528b57b?q=80&w=1920&auto=format&fit=crop"
                alt="Masjidil Haram" class="w-full h-full object-cover object-center scale-105 animate-slow-pan">
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-black/30"></div>
        </div>

        <div class="relative z-10 container mx-auto px-4 text-center mt-16 md:mt-0">
            <div
                class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-white/10 border border-white/20 backdrop-blur-md mb-8 animate-fade-in-down">
                <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                <span class="text-white/90 text-sm font-medium tracking-wide uppercase">#1 Biro Travel Terpercaya</span>
            </div>

            <h1
                class="text-4xl md:text-6xl lg:text-7xl font-serif font-bold text-white mb-6 leading-tight drop-shadow-2xl tracking-tight">
                Menuju Baitullah <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-accent to-yellow-200 italic">Sepenuh
                    Hati</span>
            </h1>

            <p class="text-lg md:text-xl text-gray-300 mb-10 max-w-2xl mx-auto font-light leading-relaxed">
                Kami mendampingi perjalanan ibadah Anda dengan pelayanan profesional, fasilitas terbaik, dan bimbingan
                sesuai sunnah.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('packages.catalog') }}"
                    class="group relative px-8 py-4 bg-accent text-white font-bold rounded-full overflow-hidden shadow-lg hover:shadow-accent/50 transition-all duration-300 transform hover:-translate-y-1 w-full sm:w-auto">
                    <span
                        class="absolute inset-0 w-full h-full bg-gradient-to-r from-accent via-yellow-500 to-accent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    <span class="relative flex items-center justify-center gap-2">
                        Lihat Paket Umroh
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </span>
                </a>
                <a href="{{ route('contact') }}"
                    class="px-8 py-4 bg-white/5 backdrop-blur-sm border border-white/30 text-white font-bold rounded-full hover:bg-white hover:text-primary transition-all duration-300 w-full sm:w-auto">
                    Hubungi Kami
                </a>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce hidden md:block">
            <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

    <section class="relative z-20 -mt-16 container mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 border-b-4 border-accent">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:divide-x divide-gray-100">
                <div class="text-center group">
                    <p
                        class="text-4xl md:text-5xl font-bold font-serif text-primary mb-2 group-hover:scale-110 transition-transform duration-300">
                        5+</p>
                    <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Tahun Pengalaman</p>
                </div>
                <div class="text-center group">
                    <p
                        class="text-4xl md:text-5xl font-bold font-serif text-primary mb-2 group-hover:scale-110 transition-transform duration-300">
                        2k+</p>
                    <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Jemaah Berangkat</p>
                </div>
                <div class="text-center group">
                    <p
                        class="text-4xl md:text-5xl font-bold font-serif text-primary mb-2 group-hover:scale-110 transition-transform duration-300">
                        100%</p>
                    <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Kepuasan Jemaah</p>
                </div>
                <div class="text-center group">
                    <p
                        class="text-4xl md:text-5xl font-bold font-serif text-primary mb-2 group-hover:scale-110 transition-transform duration-300">
                        A</p>
                    <p class="text-sm text-gray-500 font-medium uppercase tracking-wider">Akreditasi Resmi</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gray-50">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-sm font-bold text-accent tracking-widest uppercase mb-2">Mengapa Memilih Kami?</h2>
                <h3 class="text-3xl md:text-4xl font-serif font-bold text-primary mb-6">Keutamaan Layanan Barokah Travel
                </h3>
                <p class="text-gray-600 text-lg">Kenyamanan dan kekhusyukan ibadah Anda adalah prioritas utama kami. Kami
                    hadirkan standar pelayanan terbaik.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div
                    class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-primary/5 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary transition-colors duration-300">
                        <svg class="w-8 h-8 text-primary group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">Hotel Dekat
                        Masjid</h4>
                    <p class="text-gray-500 leading-relaxed">Akomodasi hotel bintang 5 ring 1 yang sangat dekat dengan
                        pelataran Masjidil Haram dan Masjid Nabawi untuk kemudahan ibadah.</p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-primary/5 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary transition-colors duration-300">
                        <svg class="w-8 h-8 text-primary group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">Pembimbing
                        Bersertifikat</h4>
                    <p class="text-gray-500 leading-relaxed">Didampingi oleh Muthawif berpengalaman lulusan Timur Tengah
                        yang membimbing tata cara ibadah sesuai tuntunan sunnah.</p>
                </div>

                <div
                    class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group hover:-translate-y-2">
                    <div
                        class="w-16 h-16 bg-primary/5 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-primary transition-colors duration-300">
                        <svg class="w-8 h-8 text-primary group-hover:text-white transition-colors duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">Pasti
                        Berangkat</h4>
                    <p class="text-gray-500 leading-relaxed">Jadwal keberangkatan yang terjamin, tiket pesawat *confirmed*
                        dengan maskapai penerbangan terbaik tanpa transit.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-primary mb-3">Paket Umroh Terbaru</h2>
                    <p class="text-gray-600 text-lg">Pilihan paket perjalanan ibadah eksklusif untuk Anda.</p>
                </div>
                <a href="{{ route('packages.catalog') }}"
                    class="group flex items-center gap-2 text-primary font-bold hover:text-accent transition-colors">
                    Lihat Semua Paket
                    <span class="group-hover:translate-x-1 transition-transform">→</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($featuredPackages as $package)
                    <div
                        class="group bg-white rounded-2xl shadow-soft hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col h-full border border-gray-100 overflow-hidden relative">

                        <div class="relative h-64 overflow-hidden bg-gray-100">
                            @if ($package->cover_image_path)
                                <img src="{{ Storage::url($package->cover_image_path) }}" alt="{{ $package->name }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300 bg-gray-100">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-60"></div>

                            <div
                                class="absolute top-4 right-4 bg-white/95 backdrop-blur px-3 py-1.5 rounded-full text-xs font-bold text-primary shadow-sm flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                                Sisa {{ $package->quota }} Kursi
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow relative">
                            <div class="flex items-center gap-4 text-xs font-semibold text-gray-500 mb-3">
                                <div class="flex items-center gap-1 bg-gray-50 px-2 py-1 rounded">
                                    <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $package->departure_date->format('d M Y') }}
                                </div>
                                <div class="flex items-center gap-1 bg-gray-50 px-2 py-1 rounded">
                                    <svg class="w-4 h-4 text-accent" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Jakarta
                                </div>
                            </div>

                            <h3
                                class="text-xl font-serif font-bold text-gray-900 mb-3 line-clamp-2 leading-tight group-hover:text-primary transition-colors">
                                <a href="{{ route('packages.show', $package->id) }}">
                                    {{ $package->name }}
                                </a>
                            </h3>

                            <p class="text-sm text-gray-500 mb-6 line-clamp-2">
                                {{ Str::limit($package->description, 100) }}
                            </p>

                            <div class="mt-auto pt-5 border-t border-gray-100 flex justify-between items-end">
                                <div>
                                    <p class="text-xs text-gray-400 mb-0.5">Harga Mulai</p>
                                    <p class="text-xl font-bold text-primary">
                                        Rp {{ number_format($package->price / 1000000, 1, ',', '.') }} <span
                                            class="text-sm font-normal text-gray-500">Jt</span>
                                    </p>
                                </div>
                                <a href="{{ route('packages.show', $package->id) }}"
                                    class="px-5 py-2.5 rounded-lg bg-primary text-white text-sm font-bold shadow hover:bg-primary-dark transition-all transform hover:scale-105 active:scale-95">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-1 md:col-span-3 text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        <p class="text-gray-500 text-lg font-medium">Belum ada paket yang tersedia saat ini.</p>
                        <p class="text-sm text-gray-400">Nantikan penawaran terbaik dari kami segera.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="py-24 bg-primary relative overflow-hidden">
        <div class="absolute inset-0 opacity-10"
            style="background-image: url('https://www.transparenttextures.com/patterns/arabesque.png'); background-size: 300px;">
        </div>

        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-accent/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <h2 class="text-3xl md:text-5xl font-serif font-bold text-white mb-6 leading-tight">
                Siap Memenuhi Panggilan-Nya?
            </h2>
            <p class="text-white/80 text-lg md:text-xl max-w-2xl mx-auto mb-12 font-light">
                Konsultasikan rencana ibadah Anda bersama tim ahli kami. Kami siap membantu Anda mendapatkan paket terbaik
                sesuai budget dan kebutuhan.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="https://wa.me/6281234567890" target="_blank"
                    class="px-8 py-4 bg-green-500 text-white font-bold rounded-full shadow-lg hover:bg-green-600 transition-all transform hover:-translate-y-1 flex items-center justify-center gap-3">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                    </svg>
                    Chat WhatsApp
                </a>
                <a href="{{ route('contact') }}"
                    class="px-8 py-4 bg-white text-primary font-bold rounded-full shadow-lg hover:bg-gray-100 transition-all transform hover:-translate-y-1">
                    Isi Formulir Kontak
                </a>
            </div>
        </div>
    </section>

    <style>
        @keyframes slow-pan {
            0% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1.15);
            }
        }

        .animate-slow-pan {
            animation: slow-pan 20s alternate infinite ease-in-out;
        }

        @keyframes fade-in-up {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }

        @keyframes fade-in-down {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.8s ease-out forwards;
        }
    </style>

@endsection
