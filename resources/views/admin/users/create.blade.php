@extends('layouts.admin')

@section('title', 'Tambah Pengguna Baru')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="mb-8">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li>
                        <a href="{{ route('admin.users.index') }}"
                            class="text-gray-500 hover:text-primary transition-colors text-sm font-medium flex items-center group">
                            <svg class="flex-shrink-0 h-4 w-4 mr-2 text-gray-400 group-hover:text-primary"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
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
                    <h2 class="text-2xl font-bold leading-7 text-primary sm:text-3xl sm:truncate font-serif">
                        Tambah Pengguna Baru
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Isi formulir berikut untuk mendaftarkan akun baru ke dalam sistem.
                    </p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
                <div class="px-4 py-6 sm:p-8">

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                        <div class="sm:col-span-6">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">Informasi Pribadi</h3>
                            <p class="mt-1 text-sm leading-6 text-gray-500">Informasi dasar untuk identifikasi pengguna.</p>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nama
                                Lengkap</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" required
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
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                    class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6
                                    @error('email') ring-red-300 focus:ring-red-500 @enderror">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6 md:col-span-4">
                            <label for="role" class="block text-sm font-medium leading-6 text-gray-900">Peran
                                (Role)</label>
                            <div class="mt-2">
                                <select id="role" name="role" required
                                    class="block w-full rounded-md border-0 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6
                                    @error('role') ring-red-300 focus:ring-red-500 @enderror">
                                    <option value="" disabled selected>-- Pilih Peran Pengguna --</option>
                                    <option value="jamaah" {{ old('role') == 'jamaah' ? 'selected' : '' }}>Jemaah (User
                                        Biasa)</option>
                                    <option value="marketing" {{ old('role') == 'marketing' ? 'selected' : '' }}>Staf
                                        Marketing</option>
                                    <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manajer
                                    </option>
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator
                                        (Full Akses)</option>
                                </select>
                            </div>
                            @error('role')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <div class="border-t border-gray-100 mt-2"></div>
                        </div>

                        <div class="sm:col-span-6">
                            <h3 class="text-base font-semibold leading-7 text-gray-900">Keamanan Akun</h3>
                            <p class="mt-1 text-sm leading-6 text-gray-500">Tetapkan kata sandi awal yang kuat.</p>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                            <div class="mt-2">
                                <input type="password" name="password" id="password" required
                                    class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6
                                    @error('password') ring-red-300 focus:ring-red-500 @enderror">
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="password_confirmation"
                                class="block text-sm font-medium leading-6 text-gray-900">Konfirmasi Password</label>
                            <div class="mt-2">
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                    class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="flex items-center justify-end gap-x-4 border-t border-gray-900/10 bg-gray-50 px-4 py-4 sm:px-8">
                    <a href="{{ route('admin.users.index') }}"
                        class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="rounded-md bg-accent px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-yellow-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent transition-all duration-200">
                        Simpan Pengguna
                    </button>
                </div>
            </div>
        </form>

    </div>

@endsection
