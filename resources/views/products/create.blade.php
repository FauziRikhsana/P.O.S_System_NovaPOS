@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow-lg p-8">

    <h1 class="text-3xl font-bold mb-6">
        ➕ Tambah Produk
    </h1>

    <form action="{{ route('products.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <div class="grid grid-cols-2 gap-6">

            <div>

                <label class="font-semibold">
                    Kategori
                </label>

                <select name="category_id"
                        class="w-full border rounded-lg p-3">

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label class="font-semibold">
                    Supplier
                </label>

                <select name="supplier_id"
                        class="w-full border rounded-lg p-3">

                    @foreach($suppliers as $supplier)

                        <option value="{{ $supplier->id }}">
                            {{ $supplier->name }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label class="font-semibold">
                    Nama Produk
                </label>

                <input
                    type="text"
                    name="name"
                    class="w-full border rounded-lg p-3">

            </div>

            <div>

                <label class="font-semibold">
                    Stok
                </label>

                <input
                    type="number"
                    name="stock"
                    class="w-full border rounded-lg p-3">

            </div>

            <div>

                <label class="font-semibold">
                    Harga Beli
                </label>

                <input
                    type="number"
                    name="purchase_price"
                    class="w-full border rounded-lg p-3">

            </div>

            <div>

                <label class="font-semibold">
                    Harga Jual
                </label>

                <input
                    type="number"
                    name="selling_price"
                    class="w-full border rounded-lg p-3">

            </div>

            <div class="col-span-2">

                <label class="font-semibold">
                    Gambar Produk
                </label>

                <input
                    type="file"
                    name="image"
                    class="w-full border rounded-lg p-3">

            </div>

        </div>

        <div class="mt-8 flex gap-3">

            <button
                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                💾 Simpan Produk

            </button>

            <a href="{{ route('products.index') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">

                Batal

            </a>

        </div>

    </form>

</div>

@endsection