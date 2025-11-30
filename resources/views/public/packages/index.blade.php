@extends('layouts.public')

@section('title', 'Daftar Paket Umroh')

@section('content')

    <section class="relative bg-primary py-20 overflow-hidden">
        <div class="absolute inset-0 opacity-10"
            style="background-image: url('https://www.transparenttextures.com/patterns/arabesque.png'); background-size: 300px;">
        </div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/20 to-transparent"></div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-serif font-bold text-white mb-4 drop-shadow-md">
                Pilihan Paket Umroh
            </h1>
            <p class="text-white/90 text-lg max-w-2xl mx-auto font-light leading-relaxed">
                Temukan paket perjalanan ibadah yang sesuai dengan jadwal, kebutuhan, dan anggaran Anda.
            </p>
        </div>
    </section>

    <section class="bg-white border-b border-gray-200 sticky top-16 md:top-20 z-40 shadow-sm transition-all duration-300">
        <div class="container mx-auto px-4 py-4">
            <form action="{{ route('packages.catalog') }}" method="GET"
                class="flex flex-col md:flex-row gap-4 justify-between items-center">

                <div class="text-sm text-gray-500 w-full md:w-auto text-center md:text-left order-2 md:order-1">
                    Menampilkan <span
                        class="font-bold text-primary">{{ $packages->firstItem() ?? 0 }}-{{ $packages->lastItem() ?? 0 }}</span>
                    dari <span class="font-bold text-primary">{{ $packages->total() }}</span> paket
                </div>

                <div class="w-full md:w-auto flex flex-col sm:flex-row gap-3 order-1 md:order-2">
                    <div class="relative w-full sm:w-80 group">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari paket umroh..."
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-full focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all text-sm group-hover:border-gray-400">
                        <div
                            class="absolute left-3.5 top-2.5 text-gray-400 group-focus-within:text-primary transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <button type="submit"
                        class="px-6 py-2.5 bg-primary text-white font-bold rounded-full hover:bg-primary-dark transition shadow-md hover:shadow-lg text-sm flex items-center justify-center gap-2">
                        Cari Paket
                    </button>
                </div>

            </form>
        </div>
    </section>

    <section class="py-16 bg-gray-50 min-h-[600px]">
        <div class="container mx-auto px-4 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse($packages as $package)
                    <div
                        class="group bg-white rounded-2xl shadow-soft hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 flex flex-col h-full border border-gray-100 overflow-hidden relative">

                        <div class="relative h-60 overflow-hidden bg-gray-200">
                            @if ($package->cover_image_path)
                                <img src="{{ Storage::url($package->cover_image_path) }}" alt="{{ $package->name }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-100">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-60">
                            </div>

                            <div class="absolute top-4 right-4">
                                @if ($package->quota > 5)
                                    <span
                                        class="bg-white/95 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-primary shadow-sm flex items-center gap-1">
                                        {{ $package->quota }} Kursi Tersedia
                                    </span>
                                @elseif($package->quota > 0)
                                    <span
                                        class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-sm animate-pulse">
                                        Sisa {{ $package->quota }} Kursi!
                                    </span>
                                @else
                                    <span class="bg-gray-800 text-white px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                                        Full Booked
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">

                            <h3
                                class="text-xl font-serif font-bold text-gray-900 mb-5 line-clamp-2 leading-tight group-hover:text-primary transition-colors">
                                <a href="{{ route('packages.show', $package->id) }}">
                                    {{ $package->name }}
                                </a>
                            </h3>

                            <div class="space-y-3 text-sm text-gray-600 mb-6">

                                <div class="flex items-center gap-3 group/item">
                                    <div
                                        class="w-8 h-8 rounded-full bg-primary/5 group-hover/item:bg-primary/10 flex items-center justify-center text-accent flex-shrink-0 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <span class="font-medium">{{ $package->departure_date->format('d M Y') }}</span>
                                </div>

                                <div class="flex items-center gap-3 group/item">
                                    <div
                                        class="w-8 h-8 rounded-full bg-primary/5 group-hover/item:bg-primary/10 flex items-center justify-center text-accent flex-shrink-0 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <span
                                        class="font-medium truncate">{{ $package->departure_location ?? 'Start Jakarta (CGK)' }}</span>
                                </div>

                                <div class="flex items-center gap-3 group/item">
                                    <div
                                        class="w-8 h-8 rounded-full bg-primary/5 group-hover/item:bg-primary/10 flex items-center justify-center text-accent flex-shrink-0 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-500">Direct Flight (Tanpa Transit)</span>
                                </div>

                            </div>

                            <div class="mt-auto pt-5 border-t border-gray-100 flex justify-between items-center">

                                <div>
                                    <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-0.5 font-semibold">Harga
                                        Mulai</p>
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-sm font-bold text-primary">Rp</span>
                                        <span class="text-2xl font-bold text-primary tracking-tight">
                                            {{ number_format($package->price / 1000000, 1, ',', '.') }}
                                        </span>
                                        <span class="text-sm font-medium text-gray-500">Jt</span>
                                    </div>
                                </div>

                                @if ($package->quota > 0)
                                    <a href="{{ route('packages.show', $package->id) }}"
                                        class="px-5 py-2.5 bg-primary text-white text-sm font-bold rounded-lg shadow-md hover:bg-primary-dark hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                                        Detail
                                    </a>
                                @else
                                    <button disabled
                                        class="px-5 py-2.5 bg-gray-100 text-gray-400 text-sm font-bold rounded-lg cursor-not-allowed">
                                        Habis
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 py-20 text-center">
                        <div class="inline-flex items-center justify-center w-24 h-24 bg-gray-100 rounded-full mb-6">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Paket Tidak Ditemukan</h3>
                        <p class="text-gray-500 max-w-md mx-auto mb-8">
                            Maaf, kami tidak menemukan paket umroh dengan kata kunci "<span
                                class="font-bold text-dark">{{ request('search') }}</span>".
                        </p>
                        <a href="{{ route('packages.catalog') }}"
                            class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                            Reset Pencarian
                        </a>
                    </div>
                @endforelse

            </div>

            <div class="mt-16">
                {{ $packages->links() }}
            </div>

        </div>
    </section>

@endsection
