@extends('layouts.app')

@section('content')

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg">{{ session('error') }}</div>
    @endif

    <div id="scanner-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b">
                <div>
                    <h2 class="text-xl font-semibold">Pindai QR Code</h2>
                    <p class="text-sm text-gray-500">Arahkan kamera ke barcode produk.</p>
                </div>
                <button id="close-scanner" class="text-gray-500 hover:text-gray-900">Tutup</button>
            </div>
            <div class="p-6 space-y-4">
                <div id="qr-reader" class="w-full min-h-[320px] rounded-xl overflow-hidden bg-gray-100"></div>
                <div id="scanner-status" class="text-sm text-gray-600">Tekan Scan untuk memulai.</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-bold mb-5">Daftar Produk</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm border border-gray-200">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="p-3 text-left">Kode</th>
                            <th class="p-3 text-left">Produk</th>
                            <th class="p-3 text-left">Harga</th>
                            <th class="p-3 text-left">Stok</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr class="border-b last:border-b-0">
                                <td class="p-3">{{ $product->barcode }}</td>
                                <td class="p-3">{{ $product->name }}</td>
                                <td class="p-3">Rp {{ number_format($product->selling_price,0,',','.') }}</td>
                                <td class="p-3">{{ $product->stock }}</td>
                                <td class="p-3">
                                    <button type="button" class="add-product bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->selling_price }}">
                                        Tambah
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-bold mb-5">Keranjang</h2>
            <div id="cart-items" class="space-y-3 text-sm text-gray-600">
                <p class="text-gray-500 text-center py-6">Belum ada produk.</p>
            </div>

            <div class="mt-5">
                <div class="flex justify-between text-xl font-bold">
                    <span>Total Belanja</span>
                    <span id="cart-total">Rp 0</span>
                </div>
            </div>

            <form action="{{ route('sales.store') }}" method="POST" class="mt-6 space-y-4">
                @csrf
                <input type="hidden" name="items" id="items-input">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Metode Pembayaran</label>
                    <select id="payment-method" name="payment_method" class="w-full border rounded-lg p-3">
                        <option value="cash">Cash</option>
                        <option value="qris">QRIS</option>
                        <option value="transfer">Transfer</option>
                        <option value="other">Lainnya</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bayar</label>
                    <input type="number" name="paid" id="paid-input" min="0" step="100" class="w-full border rounded-lg p-3" placeholder="Masukkan nominal">
                </div>

                <div id="qris-box" class="hidden rounded-lg border border-dashed border-green-500 p-4 bg-green-50 text-sm text-green-700">
                    <div class="font-semibold">QRIS Payment</div>
                    <div id="qris-message">Silakan bayar menggunakan QRIS.</div>
                </div>

                <div class="text-sm text-gray-600">
                    <div>Kembalian: <span id="change-display">Rp 0</span></div>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg">
                    Bayar
                </button>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/html5-qrcode.min.js') }}"></script>
<script>
    const cart = [];
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const itemsInput = document.getElementById('items-input');
    const paidInput = document.getElementById('paid-input');
    const changeDisplay = document.getElementById('change-display');
    const paymentMethod = document.getElementById('payment-method');
    const qrisBox = document.getElementById('qris-box');
    const qrisMessage = document.getElementById('qris-message');
    const scannerModal = document.getElementById('scanner-modal');
    const openScanner = document.getElementById('open-scanner');
    const closeScanner = document.getElementById('close-scanner');
    const scannerStatus = document.getElementById('scanner-status');
    let html5QrcodeScanner;

    document.querySelectorAll('.add-product').forEach(button => {
        button.addEventListener('click', () => {
            const id = parseInt(button.dataset.id);
            const name = button.dataset.name;
            const price = parseFloat(button.dataset.price);
            addToCart(id, name, price);
        });
    });

    function addToCart(id, name, price) {
        const existing = cart.find(item => item.product_id === id);
        if (existing) {
            existing.qty += 1;
        } else {
            cart.push({ product_id: id, name, price, qty: 1 });
        }
        renderCart();
    }

    function renderCart() {
        if (cart.length === 0) {
            cartItems.innerHTML = '<p class="text-gray-500 text-center py-6">Belum ada produk.</p>';
            cartTotal.textContent = 'Rp 0';
            changeDisplay.textContent = 'Rp 0';
            itemsInput.value = '';
            return;
        }

        let total = 0;
        cartItems.innerHTML = cart.map(item => {
            total += item.price * item.qty;
            return `
                <div class="flex items-center justify-between gap-3 border rounded-lg p-3">
                    <div class="min-w-0">
                        <div class="font-semibold truncate">${item.name}</div>
                        <div class="text-xs text-gray-500">Rp ${item.price.toLocaleString('id-ID')} x ${item.qty}</div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" class="decrease-qty bg-gray-200 rounded px-2 py-1 text-sm" data-id="${item.product_id}">-</button>
                        <span class="font-semibold">${item.qty}</span>
                        <button type="button" class="increase-qty bg-gray-200 rounded px-2 py-1 text-sm" data-id="${item.product_id}">+</button>
                    </div>
                    <div class="font-semibold">Rp ${(item.price * item.qty).toLocaleString('id-ID')}</div>
                </div>
            `;
        }).join('');

        cartTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
        itemsInput.value = JSON.stringify(cart.map(item => ({ product_id: item.product_id, qty: item.qty })));
        updateChange();

        document.querySelectorAll('.increase-qty').forEach(button => {
            button.addEventListener('click', () => {
                const id = parseInt(button.dataset.id);
                const item = cart.find(i => i.product_id === id);
                if (item) {
                    item.qty += 1;
                    renderCart();
                }
            });
        });

        document.querySelectorAll('.decrease-qty').forEach(button => {
            button.addEventListener('click', () => {
                const id = parseInt(button.dataset.id);
                const item = cart.find(i => i.product_id === id);
                if (item) {
                    item.qty = Math.max(1, item.qty - 1);
                    renderCart();
                }
            });
        });
    }

    function updateChange() {
        const paid = parseFloat(paidInput.value) || 0;
        const total = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
        const change = paid - total;
        changeDisplay.textContent = 'Rp ' + Math.max(change, 0).toLocaleString('id-ID');
    }

    paidInput.addEventListener('input', updateChange);

    paymentMethod.addEventListener('change', () => {
        if (paymentMethod.value === 'qris') {
            qrisBox.classList.remove('hidden');
            qrisMessage.innerHTML = `
                <div class="text-center">
                    <img src="/images/qris.png" class="mx-auto w-56" alt="QRIS">
                    <p class="mt-3 font-semibold">Silakan scan QRIS untuk melakukan pembayaran.</p>
                </div>
            `;
        } else {
            qrisBox.classList.add('hidden');
        }
    });

    openScanner.addEventListener('click', async () => {
        scannerModal.classList.remove('hidden');
        scannerModal.classList.add('flex');
        await new Promise(resolve => setTimeout(resolve, 150));
        startScanner();
    });

    closeScanner.addEventListener('click', async () => {
        await stopScanner();
        scannerModal.classList.add('hidden');
        scannerModal.classList.remove('flex');
    });

    async function getPreferredCameraId() {
        const cameras = await Html5Qrcode.getCameras();
        if (!cameras || cameras.length === 0) {
            throw new Error('Tidak ada kamera terdeteksi di perangkat ini.');
        }

        const backCamera = cameras.find(camera =>
            /back|rear|environment|belakang/i.test(camera.label)
        );

        return (backCamera || cameras[cameras.length - 1]).id;
    }

    async function startScanner() {
        if (typeof Html5Qrcode === 'undefined') {
            scannerStatus.textContent = 'Library scanner gagal dimuat. Refresh halaman.';
            return;
        }

        if (!window.isSecureContext) {
            scannerStatus.textContent = 'Kamera hanya bisa diakses via HTTPS atau localhost (127.0.0.1).';
            return;
        }

        await stopScanner();
        scannerStatus.textContent = 'Meminta akses kamera...';

        html5QrcodeScanner = new Html5Qrcode('qr-reader', {
            formatsToSupport: [
                Html5QrcodeSupportedFormats.QR_CODE,
                Html5QrcodeSupportedFormats.CODE_128,
                Html5QrcodeSupportedFormats.CODE_39,
                Html5QrcodeSupportedFormats.EAN_13,
                Html5QrcodeSupportedFormats.EAN_8,
            ],
        });

        try {
            const cameraId = await getPreferredCameraId();

            await html5QrcodeScanner.start(
                cameraId,
                {
                    fps: 10,
                    qrbox: { width: 250, height: 250 },
                },
                decodedText => {
                    scannerStatus.textContent = `Barcode ditemukan: ${decodedText}`;
                    stopScanner().then(() => scanBarcode(decodedText));
                },
                () => {}
            );

            scannerStatus.textContent = 'Arahkan kamera ke barcode produk.';
        } catch (error) {
            scannerStatus.textContent = 'Tidak dapat mengakses kamera: ' + (error?.message || error);
            html5QrcodeScanner = null;
        }
    }

    async function stopScanner() {
        if (!html5QrcodeScanner) {
            return;
        }

        const scanner = html5QrcodeScanner;
        html5QrcodeScanner = null;

        try {
            if (scanner.isScanning) {
                await scanner.stop();
            }
            scanner.clear();
        } catch (error) {
            // ignore cleanup errors
        }
    }

    async function scanBarcode(barcode) {
        try {
            const response = await fetch("{{ route('sales.scan') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ barcode })
            });

            const data = await response.json();
            if (data.success) {
                addToCart(data.product.id, data.product.name, data.product.price);
                scannerStatus.textContent = `Produk ${data.product.name} berhasil ditambahkan ke keranjang.`;
            } else {
                scannerStatus.textContent = data.message || 'Produk tidak ditemukan.';
            }
        } catch (error) {
            scannerStatus.textContent = 'Gagal memindai barcode. Coba lagi.';
        }
    }
</script>
@endsection