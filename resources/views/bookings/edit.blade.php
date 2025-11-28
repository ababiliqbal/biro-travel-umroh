<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { background-color: #f8fafc; }
    </style>
</head>
<body class="min-h-screen">

<div class="max-w-6xl mx-auto py-10">

    {{-- Judul --}}
    <h1 class="text-4xl font-extrabold text-[#0F4C45]">Edit Booking</h1>
    <p class="text-gray-600 mt-2">Perbarui data booking sesuai kebutuhan.</p>

    {{-- Card --}}
    <div class="bg-white shadow-md rounded-2xl p-8 mt-8">

        <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- User ID --}}
            <div class="mb-6">
                <label class="block font-medium mb-1">User ID</label>
                <input type="number" name="user_id" required
                       value="{{ $booking->user_id }}"
                       class="w-full border-gray-300 rounded-lg p-3 focus:ring-[#0F4C45] focus:border-[#0F4C45]">
            </div>

            {{-- Package ID --}}
            <div class="mb-6">
                <label class="block font-medium mb-1">Package ID</label>
                <input type="number" name="package_id" required
                       value="{{ $booking->package_id }}"
                       class="w-full border-gray-300 rounded-lg p-3 focus:ring-[#0F4C45] focus:border-[#0F4C45]">
            </div>

            {{-- Registered By --}}
            <div class="mb-6">
                <label class="block font-medium mb-1">Registered By</label>
                <input type="number" name="registered_by"
                       value="{{ $booking->registered_by }}"
                       class="w-full border-gray-300 rounded-lg p-3 focus:ring-[#0F4C45] focus:border-[#0F4C45]">
            </div>

            {{-- Status --}}
            <div class="mb-6">
                <label class="block font-medium mb-1">Status</label>
                <input type="text" name="status" maxlength="50" required
                       value="{{ $booking->status }}"
                       class="w-full border-gray-300 rounded-lg p-3 focus:ring-[#0F4C45] focus:border-[#0F4C45]">
            </div>

            {{-- Total Price --}}
            <div class="mb-6">
                <label class="block font-medium mb-1">Total Price</label>
                <input type="number" name="total_price" required
                       value="{{ $booking->total_price }}"
                       class="w-full border-gray-300 rounded-lg p-3 focus:ring-[#0F4C45] focus:border-[#0F4C45]">
            </div>

            {{-- Tombol Submit --}}
            <button type="submit"
                class="bg-[#0F4C45] text-white px-5 py-3 rounded-lg hover:bg-[#0d3f39]">
                Update Booking
            </button>

        </form>

    </div>
</div>

</body>
</html>
