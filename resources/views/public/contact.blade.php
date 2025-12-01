@extends('layouts.public')

@section('title', 'Hubungi Kami')

@section('content')

    <div class="bg-primary/5 py-12 md:py-20 border-b border-primary/10">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-5xl font-serif font-bold text-primary mb-4">Hubungi Kami</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Punya pertanyaan seputar paket umroh atau haji? Tim kami siap membantu Anda sepenuh hati.
            </p>
        </div>
    </div>

    <section class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">

                <div class="space-y-10">

                    <div>
                        <h2 class="text-2xl font-serif font-bold text-dark mb-6">Kantor Pusat</h2>
                        <ul class="space-y-6">
                            <li class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-dark text-lg">Alamat</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Jl. Ibadah No. 1, Kebayoran Baru,<br>
                                        Jakarta Selatan, DKI Jakarta 12190
                                    </p>
                                </div>
                            </li>

                            <li class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-dark text-lg">Layanan Pelanggan</h3>
                                    <p class="text-gray-600">Telepon: (021) 1234-5678</p>
                                    <p class="text-gray-600">WhatsApp: 0812-3456-7890</p>
                                    <p class="text-gray-600">Email: info@barokahtravel.com</p>
                                </div>
                            </li>

                            <li class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center text-primary flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-dark text-lg">Jam Operasional</h3>
                                    <p class="text-gray-600">Senin - Jumat: 08.00 - 17.00 WIB</p>
                                    <p class="text-gray-600">Sabtu: 09.00 - 14.00 WIB</p>
                                    <p class="text-red-500 text-sm mt-1 font-medium">Minggu & Hari Libur Nasional Tutup</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-200 h-64 md:h-80 relative">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5109.389029854881!2d110.38984787604663!3d-7.050630269092105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b3a1e3a1529%3A0x4cda1f81771c5e97!2sUniversitas%20Negeri%20Semarang%20(UNNES)!5e1!3m2!1sid!2sid!4v1764562864827!5m2!1sid!2sid"
                            class="w-full h-full border-0" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                </div>

                <div class="lg:pl-8">
                    <div class="bg-white p-8 md:p-10 rounded-2xl shadow-xl border border-gray-100">
                        <h2 class="text-2xl font-serif font-bold text-primary mb-2">Kirim Pesan</h2>
                        <p class="text-gray-500 mb-8">Silakan isi formulir di bawah ini. Kami akan membalas pesan Anda
                            sesegera mungkin.</p>

                        <form onsubmit="event.preventDefault(); alert('Pesan Anda berhasil dikirim! (Demo Mode)');"
                            class="space-y-6">

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name" class="block text-sm font-bold text-dark mb-2">Nama
                                        Lengkap</label>
                                    <input type="text" id="name" name="name" required placeholder="Nama Anda"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition bg-gray-50 focus:bg-white">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-bold text-dark mb-2">Alamat
                                        Email</label>
                                    <input type="email" id="email" name="email" required
                                        placeholder="email@contoh.com"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition bg-gray-50 focus:bg-white">
                                </div>
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-bold text-dark mb-2">Subjek Pesan</label>
                                <select id="subject" name="subject"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition bg-gray-50 focus:bg-white">
                                    <option>Pertanyaan Umum</option>
                                    <option>Informasi Paket Umroh</option>
                                    <option>Informasi Haji</option>
                                    <option>Kerjasama / Kemitraan</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-bold text-dark mb-2">Isi Pesan</label>
                                <textarea id="message" name="message" rows="5" required
                                    placeholder="Tuliskan pertanyaan atau pesan Anda di sini..."
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary outline-none transition bg-gray-50 focus:bg-white resize-none"></textarea>
                            </div>

                            <button type="submit"
                                class="w-full py-4 bg-accent text-white font-bold rounded-xl shadow-lg hover:bg-yellow-600 hover:shadow-xl transition transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <span>Kirim Pesan Sekarang</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="bg-primary text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-4">Butuh Respon Cepat?</h2>
            <p class="mb-6 opacity-90">Chat langsung dengan customer service kami melalui WhatsApp.</p>
            <a href="https://wa.me/6281234567890" target="_blank"
                class="inline-flex items-center gap-2 px-8 py-3 bg-white text-green-600 font-bold rounded-full hover:bg-gray-100 transition shadow-lg">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                </svg>
                Chat WhatsApp
            </a>
        </div>
    </section>

@endsection
