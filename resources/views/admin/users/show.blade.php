@extends('layouts.admin')

@section('title', 'Detail Pengguna')

@section('content')

    <div class="max-w-7xl mx-auto">

        <nav class="flex mb-8" aria-label="Breadcrumb">
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
                <li>
                    <span class="text-gray-400">/</span>
                </li>
                <li class="text-sm font-medium text-gray-900" aria-current="page">Detail {{ $user->name }}</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden sticky top-24">
                    <div class="px-6 py-8 text-center border-b border-gray-100">

                        <div
                            class="inline-flex h-24 w-24 rounded-full bg-primary/10 items-center justify-center text-primary text-3xl font-serif font-bold border-4 border-white shadow-lg mb-4">
                            {{ substr($user->name, 0, 1) }}
                        </div>

                        <h2 class="text-xl font-bold text-gray-900 font-serif">{{ $user->name }}</h2>

                        <div class="mt-2 flex justify-center">
                            @php
                                $colors = [
                                    'admin' => 'bg-red-50 text-red-700 ring-red-600/10',
                                    'marketing' => 'bg-blue-50 text-blue-700 ring-blue-700/10',
                                    'manager' => 'bg-purple-50 text-purple-700 ring-purple-700/10',
                                    'jamaah' => 'bg-green-50 text-green-700 ring-green-600/20',
                                ];
                                $badgeClass = $colors[$user->role] ?? 'bg-gray-50 text-gray-600 ring-gray-500/10';
                            @endphp
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium ring-1 ring-inset {{ $badgeClass }} capitalize">
                                {{ $user->role }}
                            </span>
                        </div>
                    </div>

                    <div class="px-6 py-6 bg-gray-50/50">
                        <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-4">Info Akun</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z" />
                                        <path
                                            d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z" />
                                    </svg>
                                </div>
                                <div class="ml-3 text-sm text-gray-700 break-all">{{ $user->email }}</div>
                            </li>
                            <li class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3 text-sm text-gray-700">
                                    Gabung: <span class="font-medium">{{ $user->created_at->format('d M Y') }}</span>
                                </div>
                            </li>
                        </ul>

                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="block w-full rounded-md bg-white border border-gray-300 px-3 py-2 text-center text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-colors">
                                Edit Pengguna
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">

                @if ($user->role === 'jamaah')
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-white">
                            <h3 class="text-lg font-serif font-bold text-gray-900">Data Jemaah</h3>
                            @if ($user->jamaahProfile)
                                <span
                                    class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Lengkap</span>
                            @else
                                <span
                                    class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">Belum
                                    Lengkap</span>
                            @endif
                        </div>

                        <div class="px-6 py-6">
                            @if ($user->jamaahProfile)
                                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Nomor Telepon / WA</dt>
                                        <dd class="mt-1 text-sm font-semibold text-gray-900 flex items-center">
                                            <svg class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $user->jamaahProfile->phone_number ?? '-' }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Tanggal Lahir</dt>
                                        <dd class="mt-1 text-sm font-semibold text-gray-900 flex items-center">
                                            <svg class="h-4 w-4 mr-2 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M5.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H6a.75.75 0 01-.75-.75V12zM6 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H6zM7.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H8a.75.75 0 01-.75-.75V12z" />
                                                <path fill-rule="evenodd"
                                                    d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            {{ $user->jamaahProfile->date_of_birth ? \Carbon\Carbon::parse($user->jamaahProfile->date_of_birth)->format('d F Y') : '-' }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Nomor KTP (NIK)</dt>
                                        <dd class="mt-1 text-sm font-semibold text-gray-900 font-mono tracking-wide">
                                            {{ $user->jamaahProfile->ktp_number ?? '-' }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-1">
                                        <dt class="text-sm font-medium text-gray-500">Nomor Paspor</dt>
                                        <dd class="mt-1 text-sm font-semibold text-gray-900 font-mono tracking-wide">
                                            {{ $user->jamaahProfile->passport_number ?? '-' }}
                                        </dd>
                                    </div>

                                    <div class="sm:col-span-2">
                                        <dt class="text-sm font-medium text-gray-500">Alamat Lengkap</dt>
                                        <dd
                                            class="mt-1 text-sm font-semibold text-gray-900 leading-relaxed bg-gray-50 p-3 rounded-md border border-gray-100">
                                            {{ $user->jamaahProfile->address ?? '-' }}
                                        </dd>
                                    </div>
                                </dl>
                            @else
                                <div class="text-center py-8">
                                    <div
                                        class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-yellow-100 text-yellow-600 mb-4">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-sm font-bold text-gray-900">Data Belum Dilengkapi</h3>
                                    <p class="mt-1 text-sm text-gray-500 max-w-sm mx-auto">
                                        Pengguna ini belum melengkapi data profil jemaah mereka (KTP, Paspor, dll).
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                        <div class="mx-auto h-24 w-24 text-gray-300">
                            <svg class="h-full w-full" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="mt-2 text-sm font-semibold text-gray-900">Akun Staf Internal</h3>
                        <p class="mt-1 text-sm text-gray-500">Akun ini memiliki hak akses administratif dan tidak memerlukan
                            data paspor/umrah.</p>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection
