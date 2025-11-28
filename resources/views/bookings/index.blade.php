<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Booking</title>

    {{-- Tailwind CDN biar mirip style screenshot --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background-color: #f8fafc;
        }
    </style>
</head>
<body class="min-h-screen">

    {{-- Header Halaman --}}
    <div class="max-w-6xl mx-auto py-10">
        <h1 class="text-4xl font-extrabold text-[#0F4C45]">Daftar Booking</h1>
        <p class="text-gray-600 mt-2">Kelola data booking untuk administrasi keberangkatan Umrah.</p>
    </div>

    {{-- Card Utama --}}
    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-2xl p-8">

        {{-- Tombol Tambah --}}
        <div class="mb-6">
            <a href="{{ route('bookings.create') }}"
                class="bg-[#0F4C45] text-white px-4 py-2 rounded-lg hover:bg-[#0d3f39]">
                Tambah Booking
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="py-3 px-4">User ID</th>
                        <th class="py-3 px-4">Package ID</th>
                        <th class="py-3 px-4">Registered By</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Total Price</th>
                        <th class="py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $booking->user_id }}</td>
                            <td class="py-3 px-4">{{ $booking->package_id }}</td>
                            <td class="py-3 px-4">{{ $booking->registered_by }}</td>
                            <td class="py-3 px-4">
                                <span class="px-3 py-1 rounded-full text-sm 
                                    {{ $booking->status === 'active'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-gray-200 text-gray-700' }}">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td class="py-3 px-4">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td class="py-3 px-4 flex gap-2">

                                <a href="{{ route('bookings.show', $booking->id) }}"
                                   class="text-blue-600 hover:underline">Detail</a>

                                <a href="{{ route('bookings.edit', $booking->id) }}"
                                   class="text-yellow-600 hover:underline">Edit</a>

                                <form action="{{ route('bookings.destroy', $booking->id) }}"
                                      method="POST" onsubmit="return confirm('Yakin hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>

</body>
</html>
