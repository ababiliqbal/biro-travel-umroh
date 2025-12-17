<!DOCTYPE html>
<html>

<head>
    <title>Pesan Baru</title>
</head>

<body style="font-family: sans-serif; color: #333;">
    <h2 style="color: #0A5341;">Pesan Baru dari Website</h2>

    <p><strong>Nama Pengirim:</strong> {{ $data['name'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Subjek:</strong> {{ $data['subject'] }}</p>

    <hr>

    <p><strong>Isi Pesan:</strong></p>
    <p style="background: #f9f9f9; padding: 15px; border-left: 4px solid #0A5341;">
        {!! nl2br(e($data['message'])) !!}
    </p>
</body>

</html>
