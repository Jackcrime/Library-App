<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peringatan Denda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #d9534f;
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            text-align: left;
            color: #333;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Peringatan Denda</h2>
        </div>
        <div class="content">
            <p>Halo <strong>{{ $user->nama }}</strong>,</p>
            <p>Anda telah melewati batas waktu pengembalian buku dan dikenakan denda sebesar <strong>Rp{{ number_format($denda, 0, ',', '.') }}</strong>.</p>
            <p>Mohon segera mengembalikan buku dan membayar denda untuk menghindari denda lebih besar.</p>
            <p>Terima kasih,</p>
            <p><strong>Cerdas Terpelajar library</strong></p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Cerdas Terpelajar library. Semua Hak Dilindungi.
        </div>
    </div>
</body>
</html>
