<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna - Barokah Travel</title>
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

    <div class="min-h-screen py-8">

        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Manajemen Pengguna</h1>
                    <p class="mt-1 text-sm sm:text-base text-muted">Kelola akses dan data akun sistem.</p>
                </div>
                <a href="{{ route('admin.users.create') }}"
                    class="inline-flex items-center justify-center px-4 py-2.5 bg-accent hover:bg-accent-hover text-white text-sm font-semibold rounded-lg shadow-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-accent">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Pengguna
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                <div class="p-5 border-b border-gray-100 bg-white">
                    <form action="{{ route('admin.users.index') }}" method="GET" class="relative max-w-md">
                        <label for="search" class="sr-only">Cari pengguna</label>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm transition duration-150 ease-in-out"
                            placeholder="Cari nama, email, atau ID...">
                    </form>
                </div>

                <div class="hidden md:block overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Pengguna</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Peran</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Tanggal Gabung</th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div
                                                    class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-sm border border-primary/20">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-semibold text-gray-900">{{ $user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $badges = [
                                                'admin' => 'bg-red-50 text-red-700 ring-red-600/20',
                                                'marketing' => 'bg-blue-50 text-blue-700 ring-blue-700/10',
                                                'manager' => 'bg-purple-50 text-purple-700 ring-purple-700/10',
                                                'default' => 'bg-green-50 text-green-700 ring-green-600/20',
                                            ];
                                            $css = $badges[$user->role] ?? $badges['default'];
                                        @endphp
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ring-1 ring-inset {{ $css }} capitalize">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end items-center gap-3">
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="text-gray-400 hover:text-primary transition-colors"
                                                title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Hapus pengguna {{ $user->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-gray-400 hover:text-red-600 transition-colors"
                                                    title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="mt-2 text-sm font-medium">Data tidak ditemukan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="md:hidden">
                    <div class="grid grid-cols-1 gap-4 p-4 bg-gray-50">
                        @forelse($users as $user)
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold border border-primary/20">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-bold text-gray-900">{{ $user->name }}</h3>
                                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    @php
                                        // Array lookup sederhana untuk badge mobile
                                        $badges = [
                                            'admin' => 'bg-red-50 text-red-700 ring-red-600/20',
                                            'marketing' => 'bg-blue-50 text-blue-700 ring-blue-700/10',
                                            'manager' => 'bg-purple-50 text-purple-700 ring-purple-700/10',
                                            'default' => 'bg-green-50 text-green-700 ring-green-600/20',
                                        ];
                                        $css = $badges[$user->role] ?? $badges['default'];
                                    @endphp
                                    <span
                                        class="inline-flex items-center px-2 py-1 rounded-md text-xs font-medium ring-1 ring-inset {{ $css }} capitalize">
                                        {{ $user->role }}
                                    </span>
                                </div>
                                <div class="mt-4 flex items-center justify-between text-sm">
                                    <span class="text-gray-500">Gabung:
                                        {{ $user->created_at->format('d M Y') }}</span>
                                    <div class="flex gap-3">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                            class="text-primary font-medium hover:underline">Edit</a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            class="inline-block" onsubmit="return confirm('Hapus?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 font-medium hover:underline">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">Data tidak ditemukan.</div>
                        @endforelse
                    </div>
                </div>

                @if ($users->hasPages())
                    <div class="px-5 py-4 border-t border-gray-200 bg-gray-50">
                        {{ $users->links() }}
                    </div>
                @endif

            </div>
        </main>
    </div>
</body>

</html>
