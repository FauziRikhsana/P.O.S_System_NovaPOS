@extends('layouts.app')

@section('content')

<div class="bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-6">

        Edit Kategori

    </h2>

    <form action="{{ route('categories.update',$category->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block mb-2">

                Pilih Kategori

            </label>

            <select
                name="name"
                class="w-full border rounded-lg p-3">
                <option value="">-- Pilih kategori --</option>
                <option value="Makanan" {{ $category->name == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                <option value="Minuman" {{ $category->name == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                <option value="Snack" {{ $category->name == 'Snack' ? 'selected' : '' }}>Snack</option>
                <option value="Mainan" {{ $category->name == 'Mainan' ? 'selected' : '' }}>Mainan</option>
                <option value="Elektronik" {{ $category->name == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                <option value="Pakaian" {{ $category->name == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                <option value="Kecantikan" {{ $category->name == 'Kecantikan' ? 'selected' : '' }}>Kecantikan</option>
                <option value="Alat Tulis" {{ $category->name == 'Alat Tulis' ? 'selected' : '' }}>Alat Tulis</option>
                <option value="Rumah Tangga" {{ $category->name == 'Rumah Tangga' ? 'selected' : '' }}>Rumah Tangga</option>
                <option value="Lainnya" {{ $category->name == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>

        </div>

        <button
            class="bg-blue-600 text-white px-5 py-3 rounded">

            Update

        </button>

    </form>

</div>

@endsection