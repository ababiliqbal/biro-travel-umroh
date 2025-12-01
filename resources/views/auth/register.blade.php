<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Barokah Travel</title>

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

    <div class="min-h-screen flex flex-row-reverse">

        <div class="hidden lg:flex lg:w-1/2 relative bg-primary overflow-hidden">
            <img src="{{ asset('img/kabah.jpg') }}" alt="Ka'bah Mekkah"
                class="absolute inset-0 w-full h-full object-cover opacity-60 mix-blend-overlay">

            <div class="relative z-10 flex flex-col justify-between w-full p-12 text-white text-right">
                <div>
                    <a href="{{ url('/') }}"
                        class="inline-flex items-center gap-2 text-white/90 hover:text-white transition justify-end w-full">
                        <span class="font-bold tracking-wide">Barokah Travel</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M2 10h20v11a1 1 0 01-1 1H3a1 1 0 01-1-1V10zm2-2h16V7H4v1zm2-4h12V3H6v1z" />
                        </svg>
                    </a>
                </div>

                <div class="mb-10">
                    <h2 class="text-4xl font-serif font-bold leading-tight mb-4">
                        "Langkah Awal <br> Menuju Baitullah"
                    </h2>
                    <p class="text-white/80 text-lg font-light ml-auto max-w-md">
                        Bergabunglah bersama ribuan jemaah kami dan wujudkan impian ibadah Anda dengan pelayanan
                        terbaik.
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
                    <h2 class="mt-6 text-3xl font-serif font-bold text-gray-900">Buat Akun Baru</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Sudah terdaftar?
                        <a href="{{ route('login') }}" class="font-medium text-primary hover:text-green-700 transition">
                            Masuk di sini
                        </a>
                    </p>
                </div>

                <div class="mt-8">

                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Nama Lengkap
                            </label>
                            <div class="mt-1">
                                <input id="name" name="name" type="text" autocomplete="name" required
                                    autofocus value="{{ old('name') }}"
                                    class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm @error('name') border-red-500 @enderror">
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Alamat Email
                            </label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    value="{{ old('email') }}"
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
                                <input id="password" name="password" type="password" autocomplete="new-password"
                                    required
                                    class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm @error('password') border-red-500 @enderror">
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                Konfirmasi Password
                            </label>
                            <div class="mt-1">
                                <input id="password_confirmation" name="password_confirmation" type="password"
                                    autocomplete="new-password" required
                                    class="appearance-none block w-full px-3 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                            </div>
                            @error('password_confirmation')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-accent hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent transition transform hover:-translate-y-0.5">
                                Daftar Sekarang
                            </button>
                        </div>
                    </form>

                    <div class="mt-6 text-center">
                        <p class="text-xs text-gray-500">
                            Dengan mendaftar, Anda menyetujui
                            <a href="#" class="text-primary hover:underline">Syarat & Ketentuan</a>
                            serta
                            <a href="#" class="text-primary hover:underline">Kebijakan Privasi</a> kami.
                        </p>
                    </div>

                    <div class="mt-6 border-t border-gray-200 pt-6 text-center">
                        <a href="{{ route('home') }}"
                            class="text-sm font-medium text-gray-500 hover:text-primary transition flex items-center justify-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>
