@extends('layouts.public')

@section('title', 'Tentang Kami')

@section('content')

    <section class="relative bg-primary py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-10"
            style="background-image: url('https://www.transparenttextures.com/patterns/arabesque.png');">
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-serif font-bold text-white mb-4">
                Tentang Barokah Travel
            </h1>
            <p class="text-white/80 text-lg max-w-2xl mx-auto font-light">
                Melayani Tamu Allah dengan Amanah, Profesional, dan Sepenuh Hati sejak 2015.
            </p>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <div class="relative">
                    <div class="absolute -top-4 -left-4 w-full h-full bg-accent/20 rounded-2xl"></div>
                    <img src="https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?q=80&w=1000&auto=format&fit=crop"
                        alt="Tim Barokah Travel" class="relative rounded-2xl shadow-xl w-full object-cover h-[400px] z-10">

                    <div
                        class="absolute -bottom-6 -right-6 z-20 bg-white p-6 rounded-xl shadow-lg border-l-4 border-primary max-w-xs hidden md:block">
                        <p class="text-xs text-gray-500 uppercase tracking-wide font-bold">Izin Resmi Kemenag</p>
                        <p class="text-xl font-bold text-primary mt-1">PPIU No. 123/2020</p>
                        <p class="text-xs text-gray-400 mt-2">Terakreditasi A</p>
                    </div>
                </div>

                <div class="lg:pl-8">
                    <h2 class="text-sm font-bold text-accent uppercase tracking-widest mb-2">Siapa Kami</h2>
                    <h3 class="text-3xl md:text-4xl font-serif font-bold text-dark mb-6">
                        Mitra Terpercaya Perjalanan Ibadah Anda
                    </h3>
                    <div class="space-y-4 text-gray-600 leading-relaxed text-justify">
                        <p>
                            <strong class="text-primary">PT Barokah Travel Indonesia</strong> didirikan atas dasar kerinduan
                            untuk memfasilitasi umat Muslim dalam menunaikan ibadah ke Tanah Suci dengan nyaman dan tenang.
                            Kami memahami bahwa Umroh bukan sekadar perjalanan fisik, melainkan perjalanan spiritual yang
                            membutuhkan pembimbingan yang tepat.
                        </p>
                        <p>
                            Selama lebih dari 8 tahun, kami telah memberangkatkan ribuan jemaah dengan prioritas utama:
                            **Keamanan, Kenyamanan, dan Kesesuaian Sunnah**. Kami memastikan setiap detail perjalanan, mulai
                            dari visa hingga akomodasi hotel dekat masjid, tertangani dengan sempurna.
                        </p>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mt-8 pt-8 border-t border-gray-100">
                        <div>
                            <span class="block text-3xl font-bold text-primary">8+</span>
                            <span class="text-xs text-gray-500 uppercase">Tahun Pengalaman</span>
                        </div>
                        <div>
                            <span class="block text-3xl font-bold text-primary">5k+</span>
                            <span class="text-xs text-gray-500 uppercase">Jemaah Berangkat</span>
                        </div>
                        <div>
                            <span class="block text-3xl font-bold text-primary">100%</span>
                            <span class="text-xs text-gray-500 uppercase">Amanah</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-base">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-serif font-bold text-primary mb-4">Visi & Misi</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Komitmen kami untuk memberikan standar pelayanan terbaik bagi
                    para tamu Allah.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border-t-4 border-accent hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-3">Visi Kami</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Menjadi penyelenggara ibadah Umroh dan Haji khusus yang terdepan, terpercaya, dan profesional dengan
                        mengutamakan pelayanan berkualitas internasional.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border-t-4 border-primary hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-3">Bimbingan Sesuai Sunnah</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Memberikan edukasi dan bimbingan ibadah yang sesuai dengan tuntunan Al-Quran dan Sunnah, didampingi
                        asatidz berkompeten.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-sm border-t-4 border-secondary hover:shadow-lg transition">
                    <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-dark mb-3">Kepuasan Jemaah</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Memberikan pelayanan prima (Service Excellence) mulai dari pendaftaran, keberangkatan, hingga
                        kepulangan ke tanah air.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-serif font-bold text-primary mb-4">Manajemen Kami</h2>
                <p class="text-gray-600">Dipimpin oleh individu yang berpengalaman dan berdedikasi.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="text-center group">
                    <div
                        class="relative w-48 h-48 mx-auto mb-4 rounded-full overflow-hidden border-4 border-gray-100 group-hover:border-primary transition">
                        <img src="{{ asset('img/jokowi.jpg') }}" alt="CEO" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-bold text-dark">H. Ahmad Fauzan, Lc.</h3>
                    <p class="text-accent font-medium text-sm uppercase tracking-wide">Direktur Utama</p>
                </div>

                <div class="text-center group">
                    <div
                        class="relative w-48 h-48 mx-auto mb-4 rounded-full overflow-hidden border-4 border-gray-100 group-hover:border-primary transition">
                        <img src="{{ asset('img/jokowi.jpg') }}" alt="Manager" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-bold text-dark">Hj. Siti Aminah, S.E.</h3>
                    <p class="text-accent font-medium text-sm uppercase tracking-wide">Manajer Operasional</p>
                </div>

                <div class="text-center group">
                    <div
                        class="relative w-48 h-48 mx-auto mb-4 rounded-full overflow-hidden border-4 border-gray-100 group-hover:border-primary transition">
                        <img src="{{ asset('img/jokowi.jpg') }}" alt="Ustadz" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-bold text-dark">Ust. Abdullah, M.A.</h3>
                    <p class="text-accent font-medium text-sm uppercase tracking-wide">Kepala Pembimbing</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-primary text-white text-center">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-serif font-bold mb-6">Ingin Berkonsultasi Langsung?</h2>
            <p class="text-white/80 max-w-2xl mx-auto mb-8">
                Tim kami siap menjawab segala pertanyaan Anda mengenai paket, persyaratan visa, dan persiapan ibadah.
            </p>
            <a href="{{ route('contact') }}"
                class="inline-block px-8 py-4 bg-white text-primary font-bold rounded-full shadow-lg hover:bg-accent hover:text-white transition transform hover:-translate-y-1">
                Hubungi Kami Sekarang
            </a>
        </div>
    </section>

@endsection
