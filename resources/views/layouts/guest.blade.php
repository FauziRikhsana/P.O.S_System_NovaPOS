<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NovaPOS</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gradient-to-br from-blue-700 via-blue-500 to-cyan-400">

    <div class="min-h-screen flex items-center justify-center">

        <div class="w-full max-w-5xl mx-auto px-5">

            <div class="grid md:grid-cols-2 bg-white rounded-3xl shadow-2xl overflow-hidden">

                {{-- KIRI --}}
                <div class="hidden md:flex flex-col justify-center items-center bg-gradient-to-br from-blue-700 to-blue-900 text-white p-12">

                    <div class="text-7xl mb-6">
                        🛒
                    </div>

                    <h1 class="text-4xl font-bold mb-3">
                        NovaPOS
                    </h1>

                    <p class="text-blue-100 text-center leading-7">
                        Point of Sale Management System
                        <br>
                        Kelola Produk, Supplier,
                        Penjualan dan Laporan
                        dalam satu aplikasi.
                    </p>

                </div>

                {{-- KANAN --}}
                <div class="p-10">

                    <div class="text-center mb-8">

                        <div class="text-5xl mb-3">
                            👋
                        </div>

                        <h2 class="text-3xl font-bold text-gray-800">
                            Selamat Datang
                        </h2>

                        <p class="text-gray-500 mt-2">
                            Silakan login untuk melanjutkan
                        </p>

                    </div>

                    {{ $slot }}

                    <div class="text-center mt-8 text-sm text-gray-400">
                        © {{ date('Y') }} NovaPOS
                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>