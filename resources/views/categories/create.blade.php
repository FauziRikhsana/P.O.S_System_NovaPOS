@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-6">
        Tambah Kategori
    </h2>

    <form action="{{ route('categories.store') }}" method="POST">

        @csrf

        <div class="mb-4">

            <label class="block mb-2">
                Pilih Kategori
            </label>

            <select
                name="name"
                class="w-full border rounded-lg p-3">
                <option value="">-- Pilih kategori --</option>
                <option value="Makanan">Makanan</option>
                <option value="Minuman">Minuman</option>
                <option value="Snack">Snack</option>
                <option value="Mainan">Mainan</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Pakaian">Pakaian</option>
                <option value="Kecantikan">Kecantikan</option>
                <option value="Alat Tulis">Alat Tulis</option>
                <option value="Rumah Tangga">Rumah Tangga</option>
                <option value="Lainnya">Lainnya</option>
            </select>

        </div>

        <button
            class="bg-blue-600 text-white px-5 py-3 rounded">

            Simpan

        </button>

    </form>

</div>

@endsection