@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl shadow p-6">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Kasir</h1>
        <p class="text-gray-500 mt-2">Selamat datang di panel kasir. Anda dapat mengelola transaksi dari menu yang tersedia.</p>
    </div>

    <div class="bg-green-600 text-white rounded-xl shadow p-6">
        <h2 class="text-xl font-semibold">Produk Tersedia</h2>
        <p class="text-3xl font-bold mt-3">{{ App\Models\Product::count() }}</p>
    </div>
</div>
@endsection
