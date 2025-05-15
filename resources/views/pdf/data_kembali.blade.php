<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Buku yang Dikembalikan</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            color: #333;
            font-size: 12px;
            padding: 20px;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #888;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            margin-right: 15px;
        }

        .header .title {
            text-align: center;
            flex: 1;
        }

        .header .title h1 {
            font-size: 20px;
            margin: 0;
            text-transform: uppercase;
        }

        .header .title p {
            margin: 4px 0;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #bbb;
            padding: 8px;
            text-align: left;
        }

        thead {
            background-color: #f8f8f8;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-transform: uppercase;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 30px;
            font-size: 11px;
            text-align: right;
            color: #555;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>

    <div class="header">
        <img class="text-center justify-center items-start" src="{{ public_path('assets/Logo.png') }}" alt="Logo">
        <div class="title">
            <h1>Cerdas Terlpelajar Library</h1>
            <p>Laporan Data Buku yang Telah Dikembalikan</p>
            <p>{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peminjam</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dataKembali as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->user->nama ?? '-' }}</td>
                    <td>{{ $item->buku->judul ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d-m-Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="no-data">Tidak ada data pengembalian</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i') }}
    </div>

</body>
</html>
