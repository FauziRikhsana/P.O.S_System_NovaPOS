@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow-lg p-6">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-700">
                📂 Data Kategori
            </h1>

            <p class="text-gray-500">
                Kelola semua kategori produk
            </p>
        </div>

        <a href="{{ route('categories.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg">
            + Tambah Kategori
        </a>

    </div>

    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">

            {{ session('success') }}

        </div>

    @endif

    <table class="w-full border-collapse">

        <thead>

        <tr class="bg-blue-600 text-white">

            <th class="p-3">No</th>
            <th class="p-3">Nama Kategori</th>
            <th class="p-3">Aksi</th>

        </tr>

        </thead>

        <tbody>

        @forelse($categories as $category)

            <tr class="border-b hover:bg-gray-100">

                <td class="p-3">{{ $loop->iteration }}</td>

                <td class="p-3">
                    {{ $category->name }}
                </td>

       <td class="text-right">
    <div class="flex justify-end gap-2">
        <a href="{{ route('categories.edit', $category->id) }}"
           class="bg-yellow-400 hover:bg-yellow-500 px-4 py-2 rounded">
            Edit
        </a>

        <form action="{{ route('categories.destroy', $category->id) }}"
              method="POST">
            @csrf
            @method('DELETE')

            <button
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                Hapus
            </button>
        </form>
    </div>
</td>

            </tr>

        @empty

            <tr>

                <td colspan="3" class="text-center p-5">

                    Belum ada data kategori.

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection