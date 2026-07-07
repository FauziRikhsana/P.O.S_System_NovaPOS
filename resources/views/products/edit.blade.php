@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow-lg p-8">

    <h1 class="text-3xl font-bold mb-6">
        ✏️ Edit Produk
    </h1>

    <form action="{{ route('products.update',$product->id) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-6">

            <div>
                <label>Kategori</label>

                <select name="category_id"
                        class="w-full border rounded-lg p-3">

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label>Supplier</label>

                <select name="supplier_id"
                        class="w-full border rounded-lg p-3">

                    @foreach($suppliers as $supplier)

                        <option value="{{ $supplier->id }}"
                            {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>

                            {{ $supplier->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div>

                <label>Nama Produk</label>

                <input
                    type="text"
                    name="name"
                    value="{{ $product->name }}"
                    class="w-full border rounded-lg p-3">

            </div>

            <div>

                <label>Stok</label>

                <input
                    type="number"
                    name="stock"
                    value="{{ $product->stock }}"
                    class="w-full border rounded-lg p-3">

            </div>

            <div>

                <label>Harga Beli</label>

                <input
                    type="number"
                    name="purchase_price"
                    value="{{ $product->purchase_price }}"
                    class="w-full border rounded-lg p-3">

            </div>

            <div>

                <label>Harga Jual</label>

                <input
                    type="number"
                    name="selling_price"
                    value="{{ $product->selling_price }}"
                    class="w-full border rounded-lg p-3">

            </div>

            <div class="col-span-2">

                <label>Gambar Produk</label>

                <input
                    type="file"
                    name="image"
                    class="w-full border rounded-lg p-3">

            </div>

            @if($product->image)

            <div class="col-span-2">

                <img src="{{ asset('storage/'.$product->image) }}"
                     class="w-40 rounded-lg shadow">

            </div>

            @endif

        </div>

        <div class="mt-8">

            <button
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg">

                Update Produk

            </button>

        </div>

    </form>

</div>

@endsection