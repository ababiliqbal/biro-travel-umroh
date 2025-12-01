<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Area Jamaah') - Barokah Travel</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        serif: ['Merriweather', 'Georgia', 'serif'],
                    },
                    colors: {
                        primary: '#0A5341', // Hijau Barokah
                        'primary-dark': '#063b2e',
                        secondary: '#1A237E',
                        accent: '#D4AF37', // Emas Mewah
                        'accent-hover': '#b3922d',
                        base: '#F8F9FA',
                        dark: '#343A40',
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .sidebar-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
        }
    </style>
</head>

<body class="h-full font-sans antialiased text-gray-900 bg-base">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

        <div x-show="sidebarOpen" x-cloak class="relative z-50 md:hidden" role="dialog" aria-modal="true">

            <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm"
                @click="sidebarOpen = false"></div>

            <div x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                class="fixed inset-y-0 left-0 flex w-full max-w-xs px-6 py-6 bg-primary text-white shadow-xl">

                <div class="flex flex-col flex-grow gap-y-5 overflow-y-auto sidebar-scroll">
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-serif font-bold tracking-wide">Barokah<span
                                class="text-accent">.</span></span>
                        <button type="button" @click="sidebarOpen = false"
                            class="-m-2.5 p-2.5 text-white/70 hover:text-white transition">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <nav class="flex flex-1 flex-col mt-4">
                        <ul role="list" class="flex flex-1 flex-col gap-y-4">
                            <li>
                                <a href="{{ route('jamaah.bookings.index') }}"
                                    class="group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all duration-200 {{ request()->routeIs('jamaah.bookings.*') ? 'bg-white/10 text-white shadow-inner' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                                    <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('jamaah.bookings.*') ? 'text-accent' : 'text-white/70 group-hover:text-white' }}"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                    Dashboard & Pendaftaran
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('jamaah.profile.edit') }}"
                                    class="group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all duration-200 {{ request()->routeIs('jamaah.profile.*') ? 'bg-white/10 text-white shadow-inner' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
                                    <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('jamaah.profile.*') ? 'text-accent' : 'text-white/70 group-hover:text-white' }}"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                    Profil Saya
                                </a>
                            </li>
                        </ul>

                        <div class="mt-auto border-t border-white/10 pt-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="group flex w-full items-center gap-x-3 rounded-md p-3 text-sm font-semibold leading-6 text-white/80 hover:bg-red-500/20 hover:text-red-200 transition-all">
                                    <svg class="h-6 w-6 shrink-0 text-white/70 group-hover:text-red-200" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                    </svg>
                                    Keluar (Logout)
                                </button>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

        <div class="hidden md:fixed md:inset-y-0 md:z-50 md:flex md:w-72 md:flex-col">
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-primary px-6 pb-4 sidebar-scroll shadow-2xl">
                <div class="flex h-20 shrink-0 items-center justify-center border-b border-white/10">
                    <a href="{{ route('home') }}"
                        class="text-2xl font-serif font-bold text-white tracking-wide hover:opacity-90 transition">
                        Barokah<span class="text-accent">Travel</span>
                    </a>
                </div>

                <nav class="flex flex-1 flex-col mt-4">
                    <ul role="list" class="flex flex-1 flex-col gap-y-2">

                        <li>
                            <a href="{{ route('jamaah.bookings.index') }}"
                                class="group flex gap-x-3 rounded-md p-3 text-sm leading-6 font-semibold transition-all duration-200 {{ request()->routeIs('jamaah.bookings.*') ? 'bg-white/10 text-white shadow-inner ring-1 ring-white/10' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                                <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('jamaah.bookings.*') ? 'text-accent' : 'text-white/60 group-hover:text-white' }}"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                </svg>
                                Pendaftaran Saya
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('jamaah.profile.edit') }}"
                                class="group flex gap-x-3 rounded-md p-3 text-sm leading-6 font-semibold transition-all duration-200 {{ request()->routeIs('jamaah.profile.*') ? 'bg-white/10 text-white shadow-inner ring-1 ring-white/10' : 'text-white/80 hover:bg-white/5 hover:text-white' }}">
                                <svg class="h-6 w-6 shrink-0 {{ request()->routeIs('jamaah.profile.*') ? 'text-accent' : 'text-white/60 group-hover:text-white' }}"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                Profil Saya
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('home') }}"
                                class="group flex gap-x-3 rounded-md p-3 text-sm leading-6 font-semibold text-white/80 hover:bg-white/5 hover:text-white transition-all duration-200">
                                <svg class="h-6 w-6 shrink-0 text-white/60 group-hover:text-white" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                Ke Halaman Utama
                            </a>
                        </li>

                        <li class="mt-auto border-t border-white/10 pt-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="group flex w-full items-center gap-x-3 rounded-md p-3 text-sm font-semibold leading-6 text-white/80 hover:bg-red-500/20 hover:text-red-100 transition-all">
                                    <svg class="h-6 w-6 shrink-0 text-white/60 group-hover:text-red-200"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="flex flex-1 flex-col md:pl-72 transition-all duration-300">

            <div
                class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 md:hidden">
                <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <div class="flex-1 text-sm font-semibold leading-6 text-gray-900">
                    @yield('title', 'Barokah Travel')
                </div>
            </div>

            <main class="py-10 flex-1 overflow-y-auto">
                <div class="px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>

            <footer class="border-t border-gray-200 bg-white py-4 text-center text-xs text-gray-500">
                &copy; {{ date('Y') }} Barokah Travel. Melayani dengan Sepenuh Hati.
            </footer>
        </div>
    </div>

</body>

</html>
