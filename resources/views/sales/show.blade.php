@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Transaksi</h1>
                <p class="text-gray-500">Informasi lengkap transaksi yang Anda lakukan.</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('sales.history') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg">Kembali</a>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Ringkasan Transaksi</h2>
            <div class="space-y-3 text-sm text-gray-600">
                <div class="flex justify-between">
                    <span>Invoice</span>
                    <span class="font-semibold">{{ $sale->invoice }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Tanggal</span>
                    <span class="font-semibold">{{ $sale->created_at->format('d-m-Y H:i') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Kasir</span>
                    <span class="font-semibold">{{ $sale->user->name ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Metode</span>
                    <span class="font-semibold">{{ ucfirst($sale->payment_method ?? 'cash') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Total</span>
                    <span class="font-semibold">Rp {{ number_format($sale->total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Bayar</span>
                    <span class="font-semibold">Rp {{ number_format($sale->paid, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Kembalian</span>
                    <span class="font-semibold">Rp {{ number_format($sale->change, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white rounded-xl shadow p-6 overflow-x-auto">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Detail Barang</h2>
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Produk</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Qty</th>
                        <th class="px-4 py-3">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sale->details as $index => $detail)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $detail->product->name ?? '-' }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">{{ $detail->qty }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection