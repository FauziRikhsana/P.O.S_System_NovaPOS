@extends('layouts.app')

@section('content')

@php
    $qrcode = new \Milon\Barcode\DNS2D();
@endphp

<div class="flex justify-between items-center mb-6">

    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            📦 Data Produk
        </h1>

        <p class="text-gray-500">
            Kelola seluruh data produk.
        </p>
    </div>

    <a href="{{ route('products.create') }}"
       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg shadow">
        + Tambah Produk
    </a>

</div>

@if(session('success'))
<div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded-lg mb-5">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-xl shadow overflow-x-auto">

    <table class="w-full">

        <thead>

            <tr class="bg-blue-600 text-white">

                <th class="p-4">Gambar</th>
                <th class="p-4">QR Code</th>
                <th class="p-4">Nama</th>
                <th class="p-4">Kategori</th>
                <th class="p-4">Supplier</th>
                <th class="p-4">Stok</th>
                <th class="p-4">Harga Jual</th>
                <th class="p-4">Aksi</th>

            </tr>

        </thead>

        <tbody>

        @forelse($products as $product)

            <tr class="border-b hover:bg-gray-50">

                {{-- Gambar --}}
                <td class="p-4 text-center">

                    @if($product->image)

                        <img src="{{ asset('storage/'.$product->image) }}"
                             class="w-16 h-16 rounded object-cover mx-auto">

                    @else

                        <span class="text-gray-400">
                            Tidak ada
                        </span>

                    @endif

                </td>

                {{-- QR CODE --}}
                <td class="p-4 text-center">

                    {!! $qrcode->getBarcodeHTML($product->barcode, 'QRCODE', 4, 4) !!}

                    <div class="text-xs mt-2 text-gray-700 font-semibold">
                        {{ $product->barcode }}
                    </div>

                </td>

                {{-- Nama --}}
                <td class="p-4">
                    {{ $product->name }}
                </td>

                {{-- Kategori --}}
                <td class="p-4">

                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full">

                        {{ $product->category->name }}

                    </span>

                </td>

                {{-- Supplier --}}
                <td class="p-4">
                    {{ $product->supplier->name }}
                </td>

                {{-- Stock --}}
                <td class="p-4">

                    @if($product->stock > 10)

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                            {{ $product->stock }}

                        </span>

                    @else

                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                            {{ $product->stock }}

                        </span>

                    @endif

                </td>

                {{-- Harga --}}
                <td class="p-4">

                    Rp {{ number_format($product->selling_price,0,',','.') }}

                </td>

                {{-- Aksi --}}
                <td class="p-4">

                    <div class="flex justify-center gap-2">

                        <a href="{{ route('products.edit',$product->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded">

                            Edit

                        </a>

                        <form action="{{ route('products.destroy',$product->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Hapus produk?')"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">

                                Hapus

                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="8" class="text-center p-8 text-gray-500">

                    Belum ada produk.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection