@extends('layouts.admin')

@section('title', 'Edit Paket Umroh')

@section('content')

    <div class="max-w-4xl mx-auto">

        <div class="mb-8">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li>
                        <a href="{{ route('admin.packages.index') }}"
                            class="text-gray-500 hover:text-primary transition-colors text-sm font-medium flex items-center group">
                            <svg class="flex-shrink-0 h-4 w-4 mr-2 text-gray-400 group-hover:text-primary"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                            Kembali ke Katalog
                        </a>
                    </li>
                </ol>
            </nav>
            <div class="md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-primary sm:text-3xl sm:truncate font-serif">
                        Edit Paket Perjalanan
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Perbarui informasi paket: <span class="font-semibold text-gray-900">{{ $package->name }}</span>
                    </p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.packages.update', $package->id) }}" method="POST" enctype="multipart/form-data"
            x-data="{
                imagePreview: '{{ $package->cover_image_path ? Storage::url($package->cover_image_path) : null }}',
                originalImage: '{{ $package->cover_image_path ? Storage::url($package->cover_image_path) : null }}',
                isChanged: false
            }">
            @csrf
            @method('PUT')

            <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
                <div class="px-4 py-6 sm:p-8">

                    <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                        <div class="sm:col-span-6">
                            <h3 class="text-base font-semibold leading-7 text-gray-900 border-b pb-2 mb-4">Informasi Dasar
                                Paket</h3>
                        </div>

                        <div class="sm:col-span-4">
                            <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nama
                                Paket</label>
                            <div class="mt-2">
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $package->name) }}" required
                                    class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label for="departure_date" class="block text-sm font-medium leading-6 text-gray-900">Tanggal
                                Keberangkatan</label>
                            <div class="mt-2">
                                <input type="date" name="departure_date" id="departure_date"
                                    value="{{ old('departure_date', $package->departure_date->format('Y-m-d')) }}" required
                                    class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                            </div>
                            @error('departure_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Harga Per
                                Orang</label>
                            <div class="mt-2 relative rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="text-gray-500 sm:text-sm font-semibold">Rp</span>
                                </div>
                                <input type="number" name="price" id="price"
                                    value="{{ old('price', $package->price) }}" required min="0"
                                    class="block w-full rounded-md border-0 py-2.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                            </div>
                            @error('price')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="quota" class="block text-sm font-medium leading-6 text-gray-900">Total Kuota
                                (Pax)</label>
                            <div class="mt-2">
                                <input type="number" name="quota" id="quota"
                                    value="{{ old('quota', $package->quota) }}" required min="1"
                                    class="block w-full rounded-md border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">
                            </div>
                            @error('quota')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6 mt-4">
                            <h3 class="text-base font-semibold leading-7 text-gray-900 border-b pb-2 mb-4">Media & Detail
                            </h3>
                        </div>

                        <div class="sm:col-span-6">
                            <label class="block text-sm font-medium leading-6 text-gray-900">Gambar Sampul</label>

                            <div
                                class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10 bg-gray-50 relative">

                                <template x-if="imagePreview">
                                    <div class="text-center">
                                        <div class="relative inline-block group">
                                            <img :src="imagePreview"
                                                class="mx-auto h-48 object-cover rounded-lg shadow-md mb-4 ring-1 ring-gray-200">
                                            <div class="text-xs text-gray-500 mt-2" x-show="!isChanged">Gambar saat ini
                                            </div>
                                            <div class="text-xs text-green-600 font-bold mt-2" x-show="isChanged">Gambar
                                                baru terpilih</div>
                                        </div>

                                        <div x-show="isChanged" class="mt-2">
                                            <button type="button"
                                                @click="imagePreview = originalImage; isChanged = false; $refs.fileInput.value = ''"
                                                class="text-xs text-red-600 hover:text-red-800 font-medium underline">
                                                Batalkan Perubahan
                                            </button>
                                        </div>
                                    </div>
                                </template>

                                <div class="text-center" x-show="!imagePreview">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                        aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <p class="mt-1 text-sm text-gray-600">Belum ada gambar</p>
                                </div>

                                <div class="absolute bottom-4 left-0 right-0 text-center">
                                    <label for="cover_image"
                                        class="relative cursor-pointer rounded-md bg-white font-semibold text-primary focus-within:outline-none focus-within:ring-2 focus-within:ring-primary focus-within:ring-offset-2 hover:text-primary-hover px-3 py-1 shadow-sm border border-gray-300 text-sm">
                                        <span x-text="imagePreview ? 'Ganti Gambar' : 'Pilih Gambar'"></span>
                                        <input id="cover_image" name="cover_image" type="file" class="sr-only"
                                            accept="image/*" x-ref="fileInput"
                                            @change="const file = $event.target.files[0]; if(file){ const reader = new FileReader(); reader.onload = (e) => { imagePreview = e.target.result; isChanged = true; }; reader.readAsDataURL(file); }">
                                    </label>
                                </div>
                            </div>
                            @error('cover_image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Deskripsi
                                Paket</label>
                            <div class="mt-2">
                                <textarea id="description" name="description" rows="4"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">{{ old('description', $package->description) }}</textarea>
                            </div>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="facilities" class="block text-sm font-medium leading-6 text-gray-900">Fasilitas
                                Termasuk</label>
                            <div class="mt-2">
                                <textarea id="facilities" name="facilities" rows="3"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6">{{ old('facilities', $package->facilities) }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>

                <div
                    class="flex items-center justify-end gap-x-4 border-t border-gray-900/10 bg-gray-50 px-4 py-4 sm:px-8">
                    <a href="{{ route('admin.packages.index') }}"
                        class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="rounded-md bg-accent px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-yellow-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-accent transition-all duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>

    </div>

@endsection
