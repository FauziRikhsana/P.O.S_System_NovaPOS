@extends('layouts.app')

@section('content')

<div class="grid grid-cols-4 gap-6">

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-gray-500">
            Total Produk
        </h2>

        <p class="text-4xl font-bold text-blue-600 mt-3">
            {{ $produk }}
        </p>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-gray-500">
            Kategori
        </h2>

        <p class="text-4xl font-bold text-green-600 mt-3">
            {{ $kategori }}
        </p>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-gray-500">
            Supplier
        </h2>

        <p class="text-4xl font-bold text-yellow-500 mt-3">
            {{ $supplier }}
        </p>

    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-gray-500">
            Penjualan Hari Ini
        </h2>

        <p class="text-4xl font-bold text-red-600 mt-3">
            {{ $penjualan }}
        </p>

    </div>

</div>

<div class="bg-white rounded-xl shadow p-6 mt-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-gray-700 text-xl font-semibold">Grafik Penjualan 7 Hari Terakhir</h2>
            <p class="text-sm text-gray-500">Total penjualan berdasarkan pendapatan harian.</p>
        </div>
    </div>

    <div class="mt-6">
        <canvas id="salesChart" class="w-full h-72" data-labels='@json($salesChartLabels)' data-values='@json($salesChartValues)'></canvas>
    </div>
</div>

@endsection