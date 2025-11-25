<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna - Barokah Travel</title>
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
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="font-sans bg-base text-dark antialiased">

    <div class="min-h-screen py-10">

        <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <nav class="flex mb-4" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li>
                            <a href="{{ route('admin.users.index') }}"
                                class="text-gray-500 hover:text-primary transition-colors text-sm font-medium flex items-center">
                                <svg class="flex-shrink-0 h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Kembali ke Daftar
                            </a>
                        </li>
                    </ol>
                </nav>
                <div class="md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                            Edit Pengguna
                        </h2>
                        <p class="mt-1 text-sm text-gray-500">
                            Memperbarui data akun untuk <span
                                class="font-semibold text-gray-700">{{ $user->name }}</span> (ID:
                            {{ $user->id }}).
                        </p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
                    <div class="px-4 py-6 sm:p-8">
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                            <div class="sm:col-span-6">
                                <h3 class="text-base font-semibold leading-7 text-gray-900">Informasi Profil</h3>
                                <p class="mt-1 text-sm leading-6 text-gray-500">Perbarui identitas dan peran pengguna.
                                </p>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nama
                                    Lengkap</label>
                                <div class="mt-2">
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $user->name) }}" required
                                        class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 
                                        @error('name') ring-red-300 focus:ring-red-500 @enderror">
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-3">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Alamat
                                    Email</label>
                                <div class="mt-2">
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', $user->email) }}" required
                                        class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6
                                        @error('email') ring-red-300 focus:ring-red-500 @enderror">
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-6">
                                <label for="role" class="block text-sm font-medium leading-6 text-gray-900">Peran
                                    (Role)</label>
                                <div class="mt-2">
                                    <select id="role" name="role" required
                                        class="block w-full rounded-md border-0 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6
                                        @error('role') ring-red-300 focus:ring-red-500 @enderror">
                                        @foreach (['jamaah', 'marketing', 'manager', 'admin'] as $roleOption)
                                            <option value="{{ $roleOption }}"
                                                {{ old('role', $user->role) == $roleOption ? 'selected' : '' }}>
                                                {{ ucfirst($roleOption) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('role')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-6 my-2">
                                <div class="border-t border-gray-100"></div>
                            </div>

                            <div class="sm:col-span-6">
                                <h3 class="text-base font-semibold leading-7 text-gray-900">Keamanan</h3>
                                <div class="mt-2 rounded-md bg-yellow-50 p-3 border border-yellow-200">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-yellow-800">Opsional</h3>
                                            <div class="text-sm text-yellow-700">
                                                <p>Biarkan kolom password <strong>kosong</strong> jika Anda tidak ingin
                                                    mengubah password pengguna ini.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password
                                    Baru</label>
                                <div class="mt-2">
                                    <input type="password" name="password" id="password" autocomplete="new-password"
                                        class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6
                                        @error('password') ring-red-300 focus:ring-red-500 @enderror">
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-3">
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
                        class="flex items-center justify-end gap-x-4 border-t border-gray-900/10 bg-gray-50 px-4 py-4 sm:px-8">
                        <a href="{{ route('admin.users.index') }}"
                            class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700 transition-colors">
                            Batal
                        </a>
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
