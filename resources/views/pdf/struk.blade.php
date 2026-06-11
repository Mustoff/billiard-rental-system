<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran Billiard</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
            color: #000;
            margin: 0;
            padding: 0;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 2px;
        }
        .subtitle {
            font-size: 9px;
            margin-bottom: 10px;
        }
        .line {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table td {
            padding: 3px 0;
            vertical-align: top;
        }
        .total-box {
            margin-top: 10px;
            padding: 5px;
            border: 1px solid #000;
            background-color: #f5f5f5;
        }
        .total-title {
            font-size: 10px;
            font-weight: bold;
        }
        .total-amount {
            font-size: 13px;
            font-weight: bold;
        }
        .footer {
            margin-top: 15px;
            font-size: 9px;
        }
    </style>
</head>
<body>

    <div class="text-center">
        <div class="header" style="text-align: center;">
            @if($webSetting && $webSetting->logo)
                <img src="{{ public_path('storage/' . $webSetting->logo) }}" style="width: 80px; height: auto;">
            @else
                <div style="font-size: 24px; font-weight: bold;">🎱</div>
            @endif
            
            <h2 style="margin: 5px 0;">{{ $webSetting->nama_billiard ?? 'Billiard Rental' }}</h2>
            <p style="font-size: 12px; margin: 0;">{{ $webSetting->alamat }} | Telp: {{ $webSetting->no_hp }}</p>
        </div>
        <div class="subtitle">Nota Pembayaran Prabayar</div>
    </div>

    <div class="line"></div>

    <table>
        <tr>
            <td>Pelanggan:</td>
            <td class="text-right">{{ $transaksi->pelanggan->nama }}</td>
        </tr>
        <tr>
            <td>Meja:</td>
            <td class="text-right">Meja {{ $transaksi->meja->nomor_meja }}</td>
        </tr>
        <tr>
            <td>Harga/Jam:</td>
            <td class="text-right">Rp {{ number_format($transaksi->meja->harga_per_jam, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Durasi:</td>
            <td class="text-right">{{ $transaksi->durasi_menit }} Menit</td>
        </tr>
        <tr>
            <td>Mulai:</td>
            <td class="text-right">{{ \Carbon\Carbon::parse($transaksi->jam_mulai)->format('H:i') }} WIB</td>
        </tr>
        <tr>
            <td>Selesai:</td>
            <td class="text-right">{{ \Carbon\Carbon::parse($transaksi->jam_selesai)->format('H:i') }} WIB</td>
        </tr>
    </table>

    <div class="line"></div>

    <div class="total-box">
        <table>
            <tr>
                <td class="total-title">TOTAL BAYAR:</td>
                <td class="text-right total-amount">Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="text-center footer">
        <p style="margin: 0; font-weight: bold;">TERIMA KASIH</p>
        <p style="margin: 3px 0 0 0;">Harap patuhi batas waktu sewa meja.</p>
    </div>

</body>
</html>