@extends('layouts.jamaah')

@section('title', 'Profil Saya')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-primary sm:text-3xl sm:truncate font-serif">
                    Pengaturan Profil
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Kelola data pribadi dan administrasi keberangkatan Umrah Anda.
                </p>
            </div>
        </div>

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="rounded-md bg-green-50 p-4 mb-6 border border-green-200 shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3 flex-1 md:flex md:justify-between">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button @click="show = false"
                            class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none">
                            <span class="sr-only">Dismiss</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('jamaah.profile.update') }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">

                <div
                    class="flex flex-col sm:flex-row items-center gap-x-6 gap-y-4 border-b border-gray-900/5 bg-gray-50 px-6 py-6">
                    <div
                        class="h-20 w-20 flex-shrink-0 rounded-full bg-primary flex items-center justify-center text-3xl font-bold text-white shadow-md ring-4 ring-white">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <div class="text-center sm:text-left">
                        <h3 class="text-lg font-semibold leading-7 text-gray-900 font-serif">{{ $user->name }}</h3>
                        <p class="text-sm leading-6 text-gray-500">Jemaah Umrah</p>
                    </div>
                </div>

                <div class="px-4 py-6 sm:p-8">

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 mb-8">
                        <div class="sm:col-span-6">
                            <h3 class="text-base font-semibold leading-7 text-gray-900 border-b pb-2 mb-4">Informasi Akun
                            </h3>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nama
                                Lengkap</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                                    required
                                    class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Alamat
                                Email</label>
                            <div class="mt-2 relative rounded-md shadow-sm">
                                <input type="email" id="email" value="{{ $user->email }}" disabled
                                    class="block w-full rounded-md border-0 py-2.5 pr-10 text-gray-500 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 bg-gray-50 sm:text-sm sm:leading-6 cursor-not-allowed">
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Email digunakan untuk login dan tidak dapat diubah.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 mb-8">
                        <div class="sm:col-span-6">
                            <h3 class="text-base font-semibold leading-7 text-gray-900 border-b pb-2 mb-4">Data Administrasi
                            </h3>
                            <p class="text-sm text-gray-500 -mt-2 mb-4">Pastikan data sesuai dengan KTP dan Paspor.</p>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900">No. WhatsApp
                                / Telepon</label>
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
                            <label for="date_of_birth" class="block text-sm font-medium leading-6 text-gray-900">Tanggal
                                Lahir</label>
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
                            <label for="ktp_number" class="block text-sm font-medium leading-6 text-gray-900">Nomor Induk
                                Kependudukan (NIK)</label>
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
                            <label for="passport_number" class="block text-sm font-medium leading-6 text-gray-900">Nomor
                                Paspor <span class="text-gray-400 font-normal">(Opsional)</span></label>
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
                            <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Alamat Lengkap
                                (Sesuai KTP)</label>
                            <div class="mt-2">
                                <textarea name="address" id="address" rows="3" required
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">{{ old('address', $profile?->address) }}</textarea>
                            </div>
                            @error('address')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-6">
                            <h3 class="text-base font-semibold leading-7 text-gray-900 border-b pb-2 mb-4">Keamanan</h3>
                            <div class="rounded-md bg-yellow-50 p-3 mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-600" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">Ganti Password (Opsional)</h3>
                                        <div class="mt-1 text-sm text-yellow-700">
                                            <p>Biarkan kolom password kosong jika Anda tidak ingin mengubah password saat
                                                ini.</p>
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
                                    class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="password_confirmation"
                                class="block text-sm font-medium leading-6 text-gray-900">Konfirmasi Password</label>
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

    </div>

@endsection
