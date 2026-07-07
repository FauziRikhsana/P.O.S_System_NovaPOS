@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl shadow p-6">
        <h1 class="text-2xl font-bold text-gray-800">Riwayat Transaksi</h1>
        <p class="text-gray-500">Daftar transaksi yang Anda lakukan sebagai kasir.</p>
    </div>

    <div class="bg-white rounded-xl shadow p-6 overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3">No</th>
                    <th class="px-4 py-3">Invoice</th>
                    <th class="px-4 py-3">Tanggal</th>
                    <th class="px-4 py-3">Total</th>
                    <th class="px-4 py-3">Item</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sales as $index => $sale)
                    <tr class="border-t">
                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                        <td class="px-4 py-3">{{ $sale->invoice }}</td>
                        <td class="px-4 py-3">{{ $sale->created_at->format('d-m-Y H:i') }}</td>
                        <td class="px-4 py-3">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $sale->details_count }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('sales.show', $sale) }}" class="text-blue-600 hover:underline">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada riwayat transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
