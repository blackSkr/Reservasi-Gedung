<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Reservasi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 13px;
            color: #333;
            margin: 0;
            padding: 40px;
            background: #f4f4f4;
        }

        .invoice-box {
            max-width: 850px;
            margin: auto;
            background: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .company-info {
            font-size: 20px;
            font-weight: bold;
            color: #004080;
        }

        .company-contact {
            text-align: right;
            font-size: 12px;
            color: #666;
        }

        .invoice-title {
            text-align: center;
            font-size: 24px;
            margin: 30px 0 10px;
            color: #222;
            font-weight: bold;
        }

        .invoice-desc {
            text-align: center;
            font-size: 13px;
            color: #555;
            margin-bottom: 30px;
        }

        .details-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            font-size: 13px;
        }

        .details-left, .details-right {
            width: 48%;
        }

        .details-right table {
            width: 100%;
            font-size: 13px;
        }

        .details-right td {
            padding: 4px 0;
        }

        table.items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.items-table th, table.items-table td {
            padding: 12px 10px;
            border: 1px solid #ddd;
            text-align: left;
            vertical-align: top;
        }

        table.items-table th {
            background-color: #004080;
            color: #fff;
            font-weight: 600;
            text-align: center;
        }

        table.items-table td {
            font-size: 13px;
        }

        .total {
            font-weight: bold;
            color: #004080;
            text-align: right;
        }

        .status {
            text-transform: capitalize;
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            text-align: center;
        }

        .status.sudah-membayar {
            background-color: #c6f6d5;
            color: #276749;
        }

        .status.belum-membayar {
            background-color: #fed7d7;
            color: #c53030;
        }

        .grand-total {
            margin-top: 20px;
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            color: #004080;
        }

        .note {
            margin-top: 40px;
            font-size: 12px;
            color: #555;
            line-height: 1.6;
        }

        footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #aaa;
        }
    </style>
</head>
<body>
    @php
        $statusPembayaran = strtolower($reservasiList->first()->status ?? '');
    @endphp

    @if($statusPembayaran === 'sudah membayar')
    <div class="invoice-box">
        <div class="header">
            <div class="company-info">
                PT. PamsReserv
            </div>
            <div class="company-contact">
                Jl. Bukit Alaya Ruko No. 1 A, Samarinda<br>
                Email: pamsreserve@pams.id<br>
                Telp: (021) 123-4567
            </div>
        </div>

        <div class="invoice-title">INVOICE RESERVASI</div>
        <div class="invoice-desc">
            Dokumen ini merupakan bukti tagihan atas transaksi reservasi fasilitas. Mohon lakukan pembayaran sesuai dengan jumlah yang tertera di bawah ini.
        </div>

        <div class="details-section">
            <div class="details-left">
                <strong>Ditagihkan Kepada:</strong><br>
                Nama: {{ $reservasiList->first()->user->nama ?? '-' }}<br>
                Email: {{ $reservasiList->first()->user->email ?? '-' }}<br>
                Telepon: {{ $reservasiList->first()->user->telepon ?? '-' }}
            </div>

            <div class="details-right">
                <table>
                    <tr>
                        <td><strong>Nomor Invoice</strong></td>
                        <td>: INV-{{ $reservasiList->first()->id ?? '000' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Invoice</strong></td>
                        <td>: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status Pembayaran</strong></td>
                        <td>:
                            <span class="status {{ strtolower(str_replace(' ', '-', $reservasiList->first()->status ?? '')) }}">
                                {{ ucfirst($reservasiList->first()->status ?? '-') }}
                            </span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Nama Pemesan</th>
                    <th>Fasilitas</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @foreach ($reservasiList as $reservasi)
                    @php $grandTotal += $reservasi->total_reservasi; @endphp
                    <tr>
                        <td>{{ $reservasi->user->nama ?? '-' }}</td>
                        <td>{{ $reservasi->fasilitas->nama_fasilitas ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservasi->waktu_mulai)->translatedFormat('d F Y H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservasi->waktu_selesai)->translatedFormat('d F Y H:i') }}</td>
                        <td class="total">Rp {{ number_format($reservasi->total_reservasi, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="grand-total">
            Grand Total: Rp {{ number_format($grandTotal, 0, ',', '.') }}
        </div>

        <div class="note">
            <strong>Catatan:</strong><br>
            Invoice ini hanya dapat digunakan sebagai bukti pembayaran yang sah setelah transaksi diselesaikan.<br>
            Terima kasih telah menggunakan layanan PT. PamsReserv.
        </div>

        <footer>
            &copy; {{ date('Y') }} PT. PamsReserv. All rights reserved.
        </footer>
    </div>
    @else
    <div class="invoice-box" style="text-align: center; padding: 80px;">
        <h2>Invoice Tidak Tersedia</h2>
        <p>Maaf, invoice hanya dapat dicetak setelah pembayaran berhasil dilakukan.</p>
        <p>Silakan selesaikan pembayaran terlebih dahulu untuk mendapatkan invoice resmi.</p>
    </div>
    @endif
</body>
</html>
