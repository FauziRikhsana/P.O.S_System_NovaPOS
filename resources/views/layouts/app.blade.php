<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NovaPOS</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-100">

@php
    $role = Auth::check() ? Auth::user()->role : null;
@endphp

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-blue-700 text-white">

        <div class="text-center py-6 border-b border-blue-600">
            <h1 class="text-2xl font-bold">
                🛒 POS SYSTEM
            </h1>
            <p class="text-sm mt-2 text-blue-100">
                @if($role === 'admin')
                    Admin Panel
                @else
                    Kasir Panel
                @endif
            </p>
        </div>

        <nav class="mt-6">

            @if($role === 'admin')
                <a href="{{ route('dashboard') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    📊 Dashboard
                </a>

                <a href="{{ route('categories.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    🗂 Kategori
                </a>

                <a href="{{ route('suppliers.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    🚚 Supplier
                </a>

                <a href="{{ route('products.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    📦 Produk
                </a>
            @elseif($role === 'kasir')
                <a href="{{ route('kasir.dashboard') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    🏠 Dashboard Kasir
                </a>

                <a href="{{ route('sales.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    🛒 Penjualan
                </a>

                <a href="{{ route('sales.history') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    📜 Riwayat Transaksi
                </a>
            @endif

            @if($role === 'admin')
                <a href="{{ route('reports.index') }}"
                   class="block px-6 py-3 hover:bg-blue-600">
                    📄 Laporan
                </a>
            @endif

            <a href="{{ route('profile.edit') }}"
               class="block px-6 py-3 hover:bg-blue-600">
                👤 Profil
            </a>

        </nav>

    </aside>

    <!-- Content -->
    <main class="flex-1">

        <!-- Navbar -->
        <header class="bg-white shadow px-8 py-5 flex justify-between items-center">

            <h2 class="text-2xl font-bold">
                @if($role === 'admin')
                    Dashboard Admin
                @else
                    Panel Kasir
                @endif
            </h2>

            <div class="flex items-center gap-4">

                <span class="font-semibold">
                    {{ Auth::user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button
                        type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                        Logout
                    </button>
                </form>

            </div>

        </header>

        <!-- Content -->
        <section class="p-8">
            @yield('content')
        </section>

    </main>

</div>

</body>
</html>