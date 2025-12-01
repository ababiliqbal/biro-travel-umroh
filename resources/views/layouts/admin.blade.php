<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Barokah Admin</title>

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
                        'primary-dark': '#053026',
                        secondary: '#1A237E',
                        accent: '#D4AF37', // Emas
                        dark: '#1F2937', // Abu gelap
                        sidebar: '#111827', // Background Sidebar
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Scrollbar Halus */
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #374151;
            border-radius: 20px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #4B5563;
        }
    </style>
</head>

<body class="h-full font-sans antialiased text-gray-900 bg-gray-50">

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
                class="fixed inset-y-0 left-0 flex w-full max-w-xs px-6 py-6 bg-sidebar text-white shadow-xl">

                <div class="flex flex-col flex-grow gap-y-5 overflow-y-auto custom-scrollbar">
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-serif font-bold text-white tracking-wide">Barokah<span
                                class="text-accent">.</span></span>
                        <button type="button" @click="sidebarOpen = false"
                            class="-m-2.5 p-2.5 text-gray-400 hover:text-white transition">
                            <span class="sr-only">Close sidebar</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <nav class="flex flex-1 flex-col">
                        <ul role="list" class="flex flex-1 flex-col gap-y-7">
                            <li>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white border-l-4 border-accent' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                            </svg>
                                            Dashboard
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="hidden md:fixed md:inset-y-0 md:z-50 md:flex md:w-72 md:flex-col">
            <div
                class="flex grow flex-col gap-y-5 overflow-y-auto bg-sidebar px-6 pb-4 custom-scrollbar border-r border-gray-800 shadow-xl">
                <div class="flex h-16 shrink-0 items-center">
                    <span class="text-2xl font-serif font-bold text-white tracking-wide">Barokah<span
                            class="text-accent">Admin</span></span>
                </div>

                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">

                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li>
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white border-l-4 border-accent' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                                        <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                        </svg>
                                        Dashboard
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if (in_array(Auth::user()->role, ['admin', 'marketing']))
                            <li>
                                <div
                                    class="text-xs font-semibold leading-6 text-gray-500 uppercase tracking-wider mb-2">
                                    Manajemen Data</div>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <li>
                                        <a href="{{ route('admin.users.index') }}"
                                            class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-gray-800 text-white border-l-4 border-accent' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                            </svg>
                                            Pengguna
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.packages.index') }}"
                                            class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200 {{ request()->routeIs('admin.packages.*') ? 'bg-gray-800 text-white border-l-4 border-accent' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175 4.613-.747 9.713-.747 14.326 0 .584.095 1.05.421 1.343.854" />
                                            </svg>
                                            Paket Umrah
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif

                        @if (in_array(Auth::user()->role, ['admin', 'marketing']))
                            <li>
                                <div
                                    class="text-xs font-semibold leading-6 text-gray-500 uppercase tracking-wider mb-2">
                                    Operasional</div>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <li>
                                        <a href="{{ route('admin.bookings.index') }}"
                                            class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200 {{ request()->routeIs('admin.bookings.*') ? 'bg-gray-800 text-white border-l-4 border-accent' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                            </svg>
                                            Pendaftaran
                                        </a>
                                    </li>
                                    @if (Auth::user()->role === 'admin')
                                        <li>
                                            <a href="{{ route('admin.payments.index') }}"
                                                class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200 {{ request()->routeIs('admin.payments.*') ? 'bg-gray-800 text-white border-l-4 border-accent' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                                                <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                                </svg>
                                                Pembayaran
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif

                        @if (in_array(Auth::user()->role, ['admin', 'manager']))
                            <li>
                                <div
                                    class="text-xs font-semibold leading-6 text-gray-500 uppercase tracking-wider mb-2">
                                    Laporan</div>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <li>
                                        <a href="{{ route('admin.reports.finance') }}"
                                            class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200 {{ request()->routeIs('admin.reports.finance') ? 'bg-gray-800 text-white border-l-4 border-accent' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                                            </svg>
                                            Keuangan
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.reports.statistics') }}"
                                            class="group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200 {{ request()->routeIs('admin.reports.statistics') ? 'bg-gray-800 text-white border-l-4 border-accent' : 'text-gray-400 hover:text-white hover:bg-gray-800' }}">
                                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z" />
                                            </svg>
                                            Statistik Paket
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>

        <div class="flex flex-1 flex-col md:pl-72 transition-all duration-300">

            <div
                class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">

                <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                    <div class="relative flex flex-1"></div>
                    <div class="flex items-center gap-x-4 lg:gap-x-6">
                        <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200" aria-hidden="true"></div>

                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" type="button"
                                class="-m-1.5 flex items-center p-1.5 focus:outline-none" id="user-menu-button">
                                <span class="sr-only">Open user menu</span>
                                <div
                                    class="h-8 w-8 rounded-full bg-primary flex items-center justify-center text-white font-bold text-sm shadow ring-2 ring-white">
                                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                                </div>
                                <span class="hidden lg:flex lg:items-center">
                                    <span
                                        class="ml-4 text-sm font-semibold leading-6 text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</span>
                                    <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>

                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95" @click.away="open = false"
                                class="absolute right-0 z-10 mt-2.5 w-48 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                                style="display: none;">

                                <div class="px-3 py-2 border-b border-gray-100 mb-1">
                                    <p class="text-xs text-gray-500">Login sebagai</p>
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ Auth::user()->email ?? 'admin@barokah.com' }}</p>
                                </div>

                                <a href="#"
                                    class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50 hover:text-primary">Profil
                                    Saya</a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-3 py-1 text-sm leading-6 text-red-600 hover:bg-red-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <main class="py-10 flex-1 overflow-y-auto">
                <div class="px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>

            <footer class="border-t border-gray-200 bg-white py-4 text-center text-xs text-gray-500">
                &copy; {{ date('Y') }} Barokah Travel - Professional Admin Panel
            </footer>
        </div>
    </div>
</body>

</html>
