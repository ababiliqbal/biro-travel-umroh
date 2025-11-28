<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { background-color: #f8fafc; }
    </style>
</head>
<body class="min-h-screen">

<div class="max-w-6xl mx-auto py-10">

    {{-- Judul --}}
    <h1 class="text-4xl font-extrabold text-[#0F4C45]">Detail Booking</h1>
    <p class="text-gray-600 mt-2">Informasi lengkap terkait data booking.</p>

    {{-- Card --}}
    <div class="bg-white shadow-md rounded-2xl p-8 mt-8">

        <div class="space-y-4 text-lg">

            <p><span class="font-semibold">User ID:</span> {{ $booking->user_id }}</p>

            <p><span class="font-semibold">Package ID:</span> {{ $booking->package_id }}</p>

            <p><span class="font-semibold">Registered By:</span> 
                {{ $booking->registered_by ?? '-' }}
            </p>

            <p>
                <span class="font-semibold">Status:</span>
                <span class="px-3 py-1 rounded-full text-sm
                    {{ $booking->status === 'active'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-gray-200 text-gray-700' }}">
                    {{ $booking->status }}
                </span>
            </p>

            <p><span class="font-semibold">Total Price:</span> 
                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
            </p>

        </div>

        {{-- Tombol Kembali --}}
        <div class="mt-8">
            <a href="{{ route('bookings.index') }}"
               class="bg-gray-300 px-5 py-2 rounded-lg hover:bg-gray-400">
                Kembali
            </a>
        </div>

    </div>

</div>
</body>
</html>
