@extends('layouts.app')

@section('content')

<div class="bg-white p-8 rounded-xl shadow">

    <h2 class="text-3xl font-bold mb-6">
        Tambah Supplier
    </h2>

    <form action="{{ route('suppliers.store') }}" method="POST">

        @csrf

        <div class="mb-4">
            <label>Nama Supplier</label>
            <input type="text" name="name" class="w-full border rounded-lg p-3">
        </div>

        <div class="mb-4">
            <label>No Telepon</label>
            <input type="text" name="phone" class="w-full border rounded-lg p-3">
        </div>

        <div class="mb-4">
            <label>Email</label>
            <input type="email" name="email" class="w-full border rounded-lg p-3">
        </div>

        <div class="mb-4">
            <label>Alamat</label>
            <textarea name="address" class="w-full border rounded-lg p-3"></textarea>
        </div>

        <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
            Simpan
        </button>

    </form>

</div>

@endsection