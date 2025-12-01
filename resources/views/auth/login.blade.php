<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Barokah Travel</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Lora:wght@500;600;700&display=swap"
        rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'sans-serif'],
                        'serif': ['Lora', 'serif'],
                    },
                    colors: {
                        'primary': '#0A5341', // Emerald Green
                        'accent': '#D4AF37', // Gold
                        'base': '#F8F9FA',
                        'dark': '#1F2937',
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans antialiased text-gray-900 bg-base">

    <div class="min-h-screen flex">

        <div class="hidden lg:flex lg:w-1/2 relative bg-primary overflow-hidden">
            <img src="{{ asset('img/masjid.jpg') }}" alt="Gambar Masjid"
                class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay">

            <div class="relative z-10 flex flex-col justify-between w-full p-12 text-white">
                <div>
                    <a href="{{ url('/') }}"
                        class="flex items-center gap-2 text-white/90 hover:text-white transition">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2 10h20v11a1 1 0 01-1 1H3a1 1 0 01-1-1V10zm2-2h16V7H4v1zm2-4h12V3H6v1z" />
                        </svg>
                        <span class="font-bold tracking-wide">Barokah Travel</span>
                    </a>
                </div>

                <div class="mb-10">
                    <h2 class="text-4xl font-serif font-bold leading-tight mb-4">
                        "Perjalanan Hati <br> Menuju Ilahi"
                    </h2>
                    <p class="text-white/80 text-lg font-light max-w-md">
                        Masuk ke akun Anda untuk memantau status pendaftaran, pembayaran, dan persiapan ibadah umroh
                        Anda.
                    </p>
                </div>

                <div class="text-sm text-white/50">
                    &copy; {{ date('Y') }} PT Barokah Travel Indonesia.
                </div>
            </div>
        </div>

        <div
            class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white w-full lg:w-1/2">
            <div class="mx-auto w-full max-w-sm lg:w-96">

                <div class="lg:hidden text-center mb-8">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-primary">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2 10h20v11a1 1 0 01-1 1H3a1 1 0 01-1-1V10zm2-2h16V7H4v1zm2-4h12V3H6v1z" />
                        </svg>
                        <span class="text-2xl font-serif font-bold">Barokah Travel</span>
                    </a>
                </div>

                <div>
                    <h2 class="mt-6 text-3xl font-serif font-bold text-gray-900">Selamat Datang Kembali</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Belum punya akun jemaah?
                        <a href="{{ route('register') }}"
                            class="font-medium text-primary hover:text-green-700 transition">
                            Daftar sekarang
                        </a>
                    </p>
                </div>

                <div class="mt-8">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600 p-3 bg-green-50 rounded-lg">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Alamat Email
                            </label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    autofocus value="{{ old('email') }}"
                                    class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm @error('email') border-red-500 @enderror">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Password
                            </label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm @error('password') border-red-500 @enderror">
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox"
                                    class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                                <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                    Ingat saya
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-sm">
                                    <a href="{{ route('password.request') }}"
                                        class="font-medium text-primary hover:text-green-700">
                                        Lupa password?
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-accent hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent transition transform hover:-translate-y-0.5">
                                Masuk ke Akun
                            </button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">
                                    Atau kembali ke
                                </span>
                            </div>
                        </div>
                        <div class="mt-6 text-center">
                            <a href="{{ route('home') }}"
                                class="text-sm font-medium text-gray-500 hover:text-primary transition">
                                &larr; Halaman Utama
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>
