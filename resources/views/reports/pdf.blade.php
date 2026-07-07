<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background: #f3f4f6; }
        .title { font-size: 18px; font-weight: bold; margin-bottom: 6px; }
        .sub { color: #4b5563; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="title">Laporan Penjualan</div>
    <div class="sub">Periode: {{ $startDate }} s/d {{ $endDate }}</div>

    <table>
        <tr>
            <th>No</th>
            <th>Invoice</th>
            <th>Kasir</th>
            <th>Tanggal</th>
            <th>Metode</th>
            <th>Total</th>
            <th>Bayar</th>
            <th>Kembalian</th>
        </tr>
        @foreach($sales as $index => $sale)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $sale->invoice }}</td>
                <td>{{ $sale->user->name ?? '-' }}</td>
                <td>{{ $sale->created_at->format('d-m-Y H:i') }}</td>
                <td>{{ ucfirst($sale->payment_method ?? 'cash') }}</td>
                <td>Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($sale->paid, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($sale->change, 0, ',', '.') }}</td>
            </tr>
        @endforeach
    </table>

    <div style="margin-top: 12px;">
        <strong>Total Transaksi:</strong> {{ $summary['transactions'] }}<br>
        <strong>Total Penjualan:</strong> Rp {{ number_format($summary['total_sales'], 0, ',', '.') }}<br>
        <strong>Total Bayar:</strong> Rp {{ number_format($summary['total_paid'], 0, ',', '.') }}<br>
        <strong>Total Kembalian:</strong> Rp {{ number_format($summary['total_change'], 0, ',', '.') }}
    </div>
</body>
</html>
