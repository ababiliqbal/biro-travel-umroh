<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Biro Perjalanan Umroh Terpercaya dan Profesional dengan Pembimbing Sesuai Sunnah.')">
    <title>@yield('title', 'Beranda') - Barokah Travel</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Merriweather:wght@300;400;700&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        serif: ['Merriweather', 'serif'],
                    },
                    colors: {
                        primary: '#0A5341', // Hijau Barokah (Deep Emerald)
                        'primary-dark': '#063b2e',
                        secondary: '#1A237E', // Biru untuk variasi
                        accent: '#D4AF37', // Emas Mewah
                        'accent-hover': '#b3922d',
                        light: '#F9FAFB', // Background section terang
                        dark: '#1F2937', // Teks utama
                    },
                    boxShadow: {
                        'soft': '0 4px 20px -2px rgba(0, 0, 0, 0.05)',
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans text-dark antialiased flex flex-col min-h-screen bg-white">

    <header x-data="{ mobileMenuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="scrolled ? 'bg-white shadow-md py-2' : 'bg-white shadow-sm py-4'"
        class="fixed top-0 w-full z-50 transition-all duration-300 ease-in-out border-b border-gray-100/50">

        <nav class="container mx-auto px-4 lg:px-8 flex justify-between items-center">

            <a href="{{ url('/') }}" class="flex items-center gap-3 group z-50">
                <div
                    class="w-10 h-10 bg-primary text-white rounded-lg flex items-center justify-center shadow-lg group-hover:bg-primary-dark transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-serif font-bold text-primary leading-none tracking-tight">Barokah</span>
                    <span class="text-[10px] font-bold tracking-[0.2em] text-accent uppercase mt-0.5">Travel
                        Umroh</span>
                </div>
            </a>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}"
                    class="text-sm font-medium transition-colors hover:text-primary relative group {{ request()->is('/') ? 'text-primary' : 'text-gray-600' }}">
                    Beranda
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-accent transition-all duration-300 group-hover:w-full {{ request()->is('/') ? 'w-full' : '' }}"></span>
                </a>
                <a href="{{ url('/paket') }}"
                    class="text-sm font-medium transition-colors hover:text-primary relative group {{ request()->is('paket*') ? 'text-primary' : 'text-gray-600' }}">
                    Paket Umroh
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-accent transition-all duration-300 group-hover:w-full {{ request()->is('paket*') ? 'w-full' : '' }}"></span>
                </a>
                <a href="{{ url('/tentang-kami') }}"
                    class="text-sm font-medium transition-colors hover:text-primary relative group {{ request()->is('tentang-kami') ? 'text-primary' : 'text-gray-600' }}">
                    Tentang Kami
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-accent transition-all duration-300 group-hover:w-full {{ request()->is('tentang-kami') ? 'w-full' : '' }}"></span>
                </a>
                <a href="{{ url('/kontak') }}"
                    class="text-sm font-medium transition-colors hover:text-primary relative group {{ request()->is('kontak') ? 'text-primary' : 'text-gray-600' }}">
                    Kontak
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-accent transition-all duration-300 group-hover:w-full {{ request()->is('kontak') ? 'w-full' : '' }}"></span>
                </a>
            </div>

            <div class="hidden md:flex items-center gap-4">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false"
                            class="flex items-center gap-2 focus:outline-none group">
                            <div class="text-right hidden lg:block leading-tight">
                                <p class="text-[10px] text-gray-500 uppercase tracking-wider font-semibold">Assalamu'alaikum
                                </p>
                                <p class="text-sm font-bold text-primary truncate max-w-[120px]">{{ Auth::user()->name }}
                                </p>
                            </div>
                            <div
                                class="h-9 w-9 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold border border-primary/20 group-hover:bg-primary group-hover:text-white transition-colors">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-primary transition-transform duration-200"
                                :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95" x-cloak
                            class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50">
                            @if (Auth::user()->role === 'jamaah')
                                <a href="{{ route('jamaah.profile.edit') }}"
                                    class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Dashboard Saya
                                </a>
                            @else
                                <a href="{{ route('admin.users.index') }}"
                                    class="flex items-center px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                    Admin Panel
                                </a>
                            @endif
                            <div class="border-t border-gray-100 my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="flex w-full items-center px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3 text-red-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-semibold text-gray-600 hover:text-primary transition-colors">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2.5 text-sm font-bold text-white bg-accent rounded-full shadow-md hover:bg-accent-hover hover:shadow-lg transition-all transform hover:-translate-y-0.5">Daftar
                        Umroh</a>
                @endauth
            </div>

            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="md:hidden text-gray-600 focus:outline-none p-2 rounded-md hover:bg-gray-100 transition-colors">
                <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

        </nav>

        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2" x-cloak
            class="md:hidden absolute top-full left-0 w-full bg-white shadow-xl border-t border-gray-100 max-h-[80vh] overflow-y-auto">
            <div class="px-4 py-6 space-y-4">
                <a href="{{ url('/') }}"
                    class="block px-4 py-3 rounded-lg text-base font-medium hover:bg-primary/5 hover:text-primary transition-colors {{ request()->is('/') ? 'text-primary bg-primary/5 font-semibold' : 'text-gray-700' }}">Beranda</a>
                <a href="{{ url('/paket') }}"
                    class="block px-4 py-3 rounded-lg text-base font-medium hover:bg-primary/5 hover:text-primary transition-colors {{ request()->is('paket*') ? 'text-primary bg-primary/5 font-semibold' : 'text-gray-700' }}">Paket
                    Umroh</a>
                <a href="{{ url('/tentang-kami') }}"
                    class="block px-4 py-3 rounded-lg text-base font-medium hover:bg-primary/5 hover:text-primary transition-colors {{ request()->is('tentang-kami') ? 'text-primary bg-primary/5 font-semibold' : 'text-gray-700' }}">Tentang
                    Kami</a>
                <a href="{{ url('/kontak') }}"
                    class="block px-4 py-3 rounded-lg text-base font-medium hover:bg-primary/5 hover:text-primary transition-colors {{ request()->is('kontak') ? 'text-primary bg-primary/5 font-semibold' : 'text-gray-700' }}">Hubungi
                    Kami</a>

                <div class="border-t border-gray-100 pt-4 mt-2">
                    @auth
                        <div class="px-4 mb-4 flex items-center gap-3">
                            <div
                                class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        @if (Auth::user()->role === 'jamaah')
                            <a href="{{ route('jamaah.profile.edit') }}"
                                class="block w-full text-center px-4 py-3 bg-primary text-white rounded-lg font-bold shadow-sm hover:bg-primary-dark transition-colors">Dashboard
                                Saya</a>
                        @else
                            <a href="{{ route('admin.users.index') }}"
                                class="block w-full text-center px-4 py-3 bg-primary text-white rounded-lg font-bold shadow-sm hover:bg-primary-dark transition-colors">Admin
                                Panel</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="mt-3">
                            @csrf
                            <button
                                class="block w-full text-center px-4 py-3 border border-red-200 text-red-600 rounded-lg font-medium hover:bg-red-50 transition-colors">Keluar</button>
                        </form>
                    @else
                        <div class="flex flex-col gap-3">
                            <a href="{{ route('login') }}"
                                class="block w-full text-center px-4 py-3 border border-gray-300 text-gray-700 rounded-lg font-bold hover:bg-gray-50 transition-colors">Masuk</a>
                            <a href="{{ route('register') }}"
                                class="block w-full text-center px-4 py-3 bg-accent text-white rounded-lg font-bold shadow-md hover:bg-accent-hover transition-colors">Daftar
                                Sekarang</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow pt-24 md:pt-28">
        @yield('content')
    </main>

    <footer class="bg-primary text-white pt-16 pb-8 border-t-8 border-accent relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-5 pointer-events-none"
            style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 20px 20px;"></div>

        <div class="container mx-auto px-4 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">

                <div class="lg:pr-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-10 h-10 bg-white text-primary rounded-lg flex items-center justify-center shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <span class="text-2xl font-serif font-bold text-white tracking-wide">Barokah</span>
                    </div>
                    <p class="text-sm leading-relaxed text-white/80 mb-6">
                        Mitra perjalanan ibadah Anda yang amanah, profesional, dan membimbing sesuai sunnah. Resmi
                        terdaftar di Kemenag RI.
                    </p>
                    <div class="flex gap-4">
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent hover:text-white transition-all transform hover:-translate-y-1"><span
                                class="sr-only">Facebook</span>FB</a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent hover:text-white transition-all transform hover:-translate-y-1"><span
                                class="sr-only">Instagram</span>IG</a>
                        <a href="#"
                            class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent hover:text-white transition-all transform hover:-translate-y-1"><span
                                class="sr-only">Youtube</span>YT</a>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-accent mb-6 font-serif">Layanan Kami</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ url('/paket') }}"
                                class="text-white/80 hover:text-white hover:translate-x-1 transition-all inline-flex items-center"><span
                                    class="text-accent mr-2">›</span> Paket Reguler</a></li>
                        <li><a href="#"
                                class="text-white/80 hover:text-white hover:translate-x-1 transition-all inline-flex items-center"><span
                                    class="text-accent mr-2">›</span> Umroh Plus Turki</a></li>
                        <li><a href="#"
                                class="text-white/80 hover:text-white hover:translate-x-1 transition-all inline-flex items-center"><span
                                    class="text-accent mr-2">›</span> Haji Furoda</a></li>
                        <li><a href="#"
                                class="text-white/80 hover:text-white hover:translate-x-1 transition-all inline-flex items-center"><span
                                    class="text-accent mr-2">›</span> Badung Umroh</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-accent mb-6 font-serif">Informasi</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ url('/tentang-kami') }}"
                                class="text-white/80 hover:text-white hover:translate-x-1 transition-all inline-flex items-center"><span
                                    class="text-accent mr-2">›</span> Profil Perusahaan</a></li>
                        <li><a href="#"
                                class="text-white/80 hover:text-white hover:translate-x-1 transition-all inline-flex items-center"><span
                                    class="text-accent mr-2">›</span> Legalitas</a></li>
                        <li><a href="#"
                                class="text-white/80 hover:text-white hover:translate-x-1 transition-all inline-flex items-center"><span
                                    class="text-accent mr-2">›</span> Galeri Jamaah</a></li>
                        <li><a href="#"
                                class="text-white/80 hover:text-white hover:translate-x-1 transition-all inline-flex items-center"><span
                                    class="text-accent mr-2">›</span> Artikel Islami</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold text-accent mb-6 font-serif">Hubungi Kami</h3>
                    <ul class="space-y-4 text-sm text-white/90">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-accent mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Jl. Raya Condet No. 12<br>Jakarta Timur, Indonesia</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-accent shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            <span>(021) 809-1234</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-accent shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span>info@barokahtravel.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-white/10 pt-8 text-center">
                <p class="text-sm text-white/50">
                    &copy; {{ date('Y') }} PT Barokah Travel Indonesia. All rights reserved. <br
                        class="md:hidden">
                    <span class="hidden md:inline mx-2">|</span>
                    Melayani Tamu Allah Sepenuh Hati.
                </p>
            </div>
        </div>
    </footer>

</body>

</html>
