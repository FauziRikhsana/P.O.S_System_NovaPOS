@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Laporan Penjualan</h1>
            <p class="text-sm text-gray-500">Tampilkan penjualan berdasarkan rentang tanggal</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('reports.export.pdf', request()->query()) }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow">
                Cetak PDF
            </a>
            <a href="{{ route('reports.export.excel', request()->query()) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
                Export Excel
            </a>
        </div>
    </div>

    <form method="GET" action="{{ route('reports.index') }}" class="bg-white rounded-xl shadow p-6 grid md:grid-cols-4 gap-4 items-end">
        <div>
            <label class="block text-sm font-medium text-gray-700">Dari Tanggal</label>
            <input type="date" name="start_date" value="{{ $startDate }}" class="mt-1 w-full border-gray-300 rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Sampai Tanggal</label>
            <input type="date" name="end_date" value="{{ $endDate }}" class="mt-1 w-full border-gray-300 rounded-lg">
        </div>
        <div class="md:col-span-2 flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Tampilkan</button>
            <a href="{{ route('reports.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">Reset</a>
        </div>
    </form>

    <div class="grid md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-sm text-gray-500">Total Transaksi</p>
            <p class="text-2xl font-bold text-blue-600">{{ $summary['transactions'] }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-sm text-gray-500">Total Penjualan</p>
            <p class="text-2xl font-bold text-green-600">Rp {{ number_format($summary['total_sales'], 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-sm text-gray-500">Total Bayar</p>
            <p class="text-2xl font-bold text-yellow-600">Rp {{ number_format($summary['total_paid'], 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-4">
            <p class="text-sm text-gray-500">Total Kembalian</p>
            <p class="text-2xl font-bold text-red-600">Rp {{ number_format($summary['total_change'], 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Invoice</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Kasir</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Metode</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Total</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Bayar</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Kembalian</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($sales as $index => $sale)
                        <tr>
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $sale->invoice }}</td>
                            <td class="px-4 py-3">{{ $sale->user->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $sale->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-4 py-3">{{ ucfirst($sale->payment_method ?? 'cash') }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($sale->paid, 0, ',', '.') }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($sale->change, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada data penjualan pada periode ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
