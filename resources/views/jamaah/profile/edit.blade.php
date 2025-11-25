<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Barokah Travel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0A5341',
                        'primary-hover': '#084234',
                        secondary: '#1A237E',
                        accent: '#D4AF37',
                        'accent-hover': '#B8962E',
                        base: '#F8F9FA',
                        dark: '#343A40',
                        muted: '#6C757D'
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        serif: ['Merriweather', 'serif'], // Font serif untuk nuansa elegan/religi
                    }
                }
            }
        }
    </script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@400;700&display=swap"
        rel="stylesheet">
</head>

<body class="font-sans bg-base text-dark antialiased">

    <nav class="bg-primary shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-white font-serif font-bold text-xl tracking-wide">Barokah Travel</span>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/dashboard"
                        class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="bg-primary-hover hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors border border-white/10">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen py-10">

        <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="md:flex md:items-center md:justify-between mb-8">
                <div class="flex-1 min-w-0">
                    <h2
                        class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate font-serif text-primary">
                        Pengaturan Profil
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Kelola informasi pribadi Anda untuk keperluan administrasi keberangkatan Umrah.
                    </p>
                </div>
            </div>

            @if (session('success'))
                <div class="rounded-md bg-green-50 p-4 mb-6 border border-green-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('jamaah.profile.update') }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden mb-6">
                    <div class="px-4 py-6 sm:px-8">
                        <div class="flex items-center gap-x-4 mb-6 pb-6 border-b border-gray-100">
                            <div
                                class="h-16 w-16 rounded-full bg-primary flex items-center justify-center text-xl font-bold text-white shadow-md ring-4 ring-gray-50">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="text-base font-semibold leading-7 text-gray-900">Identitas Akun</h3>
                                <p class="text-sm leading-6 text-gray-500">Informasi login dan nama tampilan Anda.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nama
                                    Lengkap</label>
                                <div class="mt-2">
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $user->name) }}" required
                                        class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-1">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Alamat
                                    Email</label>
                                <div class="mt-2 relative">
                                    <input type="email" id="email" value="{{ $user->email }}" disabled
                                        class="block w-full rounded-md border-0 py-2.5 text-gray-500 bg-gray-50 shadow-sm ring-1 ring-inset ring-gray-200 sm:text-sm sm:leading-6 cursor-not-allowed">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Email digunakan sebagai ID login dan tidak dapat
                                    diubah.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden mb-6">
                    <div class="px-4 py-6 sm:px-8">
                        <div class="mb-6">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">Data Administrasi Jemaah</h3>
                            <p class="mt-1 text-sm leading-6 text-gray-500">Pastikan data di bawah ini sesuai dengan
                                <strong>KTP dan Paspor</strong> Anda.</p>
                        </div>

                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                            <div class="sm:col-span-3">
                                <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900">No.
                                    WhatsApp / Telepon</label>
                                <div class="mt-2">
                                    <input type="text" name="phone_number" id="phone_number"
                                        value="{{ old('phone_number', $profile?->phone_number) }}" required
                                        class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                                </div>
                                @error('phone_number')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-3">
                                <label for="date_of_birth"
                                    class="block text-sm font-medium leading-6 text-gray-900">Tanggal Lahir</label>
                                <div class="mt-2">
                                    <input type="date" name="date_of_birth" id="date_of_birth"
                                        value="{{ old('date_of_birth', $profile?->date_of_birth) }}" required
                                        class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                                </div>
                                @error('date_of_birth')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-3">
                                <label for="ktp_number" class="block text-sm font-medium leading-6 text-gray-900">Nomor
                                    Induk Kependudukan (NIK)</label>
                                <div class="mt-2">
                                    <input type="text" name="ktp_number" id="ktp_number"
                                        value="{{ old('ktp_number', $profile?->ktp_number) }}" required
                                        class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                                </div>
                                @error('ktp_number')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-3">
                                <label for="passport_number"
                                    class="block text-sm font-medium leading-6 text-gray-900">Nomor Paspor <span
                                        class="text-gray-400 font-normal">(Opsional)</span></label>
                                <div class="mt-2">
                                    <input type="text" name="passport_number" id="passport_number"
                                        value="{{ old('passport_number', $profile?->passport_number) }}"
                                        class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                                </div>
                                @error('passport_number')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-6">
                                <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Alamat
                                    Lengkap (Sesuai KTP)</label>
                                <div class="mt-2">
                                    <textarea name="address" id="address" rows="3" required
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">{{ old('address', $profile?->address) }}</textarea>
                                </div>
                                @error('address')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden mb-6">
                    <div class="px-4 py-6 sm:px-8">
                        <div class="mb-6">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">Keamanan</h3>
                            <p class="mt-1 text-sm leading-6 text-gray-500">Kosongkan jika tidak ingin mengubah
                                password.</p>
                        </div>
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-2">
                            <div class="sm:col-span-1">
                                <label for="password"
                                    class="block text-sm font-medium leading-6 text-gray-900">Password Baru</label>
                                <div class="mt-2">
                                    <input type="password" name="password" id="password"
                                        autocomplete="new-password"
                                        class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-1">
                                <label for="password_confirmation"
                                    class="block text-sm font-medium leading-6 text-gray-900">Konfirmasi
                                    Password</label>
                                <div class="mt-2">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        autocomplete="new-password"
                                        class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 bg-gray-50 px-4 py-4 sm:px-8">
                        <button type="button" onclick="window.history.back()"
                            class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700">Batal</button>
                        <button type="submit"
                            class="rounded-md bg-accent px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-accent-hover focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent transition-all duration-200">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>

            </form>
        </main>
    </div>
</body>

</html>
