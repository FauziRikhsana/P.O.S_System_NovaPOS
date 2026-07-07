@extends('layouts.app')

@section('content')

<div class="bg-white rounded-xl shadow-lg p-8">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-4xl font-bold">🚚 Data Supplier</h2>
            <p class="text-gray-500">
                Kelola data supplier
            </p>
        </div>

        <a href="{{ route('suppliers.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
            + Tambah Supplier
        </a>

    </div>

    <table class="w-full border-collapse">

        <thead>

            <tr class="bg-blue-600 text-white">

                <th class="p-3">No</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Aksi</th>

            </tr>

        </thead>

        <tbody>

        @forelse($suppliers as $supplier)

            <tr class="border-b">

                <td class="p-3">{{ $loop->iteration }}</td>

                <td>{{ $supplier->name }}</td>

                <td>{{ $supplier->phone }}</td>

                <td>{{ $supplier->email }}</td>

                <td>{{ $supplier->address }}</td>

                <td class="text-right">

                    <div class="flex justify-end gap-2">

                        <a href="{{ route('suppliers.edit',$supplier->id) }}"
                           class="bg-yellow-400 px-4 py-2 rounded">
                            Edit
                        </a>

                        <form action="{{ route('suppliers.destroy',$supplier->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button class="bg-red-500 text-white px-4 py-2 rounded">
                                Hapus
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="6" class="text-center py-6">
                    Belum ada data supplier
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection