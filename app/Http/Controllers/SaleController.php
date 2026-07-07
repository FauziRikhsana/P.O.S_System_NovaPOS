<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->orderBy('name')->get();

        return view('sales.index', compact('products'));
    }

    public function scan(Request $request)
    {
        $request->validate([
            'barcode' => 'required|string',
        ]);

        $product = Product::where('barcode', $request->barcode)->first();

        if (! $product) {
            return response()->json([ 'success' => false, 'message' => 'Produk dengan barcode tersebut tidak ditemukan.' ], 404);
        }

        return response()->json([
            'success' => true,
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->selling_price,
                'stock' => $product->stock,
            ],
        ]);
    }

    public function history()
    {
        $sales = Sale::where('user_id', Auth::id())
            ->withCount('details')
            ->latest()
            ->get();

        return view('sales.history', compact('sales'));
    }

    public function show(Sale $sale)
    {
        abort_unless($sale->user_id === Auth::id(), 403);

        $sale->load('details.product');

        return view('sales.show', compact('sale'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required',
            'payment_method' => 'required|string|in:cash,qris,transfer,other',
            'paid' => 'required|numeric|min:0',
        ]);

        $itemsInput = $request->input('items');
        $items = is_string($itemsInput) ? json_decode($itemsInput, true) : $itemsInput;

        if (!is_array($items) || count($items) < 1) {
            return back()->with('error', 'Keranjang masih kosong.');
        }

        $total = 0;

        foreach ($items as $item) {
            $product = Product::findOrFail($item['product_id']);

            if ($product->stock < $item['qty']) {
                return back()->with('error', 'Stok ' . $product->name . ' tidak cukup.');
            }

            $subtotal = $product->selling_price * $item['qty'];
            $total += $subtotal;
        }

        $paid = (float) $request->paid;
        $change = $paid - $total;

        $sale = Sale::create([
            'invoice' => 'INV-' . now()->format('YmdHis'),
            'user_id' => Auth::id(),
            'total' => $total,
            'paid' => $paid,
            'change' => $change,
            'payment_method' => $request->payment_method,
        ]);

        foreach ($items as $item) {
            $product = Product::findOrFail($item['product_id']);
            $product->decrement('stock', $item['qty']);

            SaleDetail::create([
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'qty' => $item['qty'],
                'price' => $product->selling_price,
                'subtotal' => $product->selling_price * $item['qty'],
            ]);
        }

        return redirect()->route('sales.index')->with('success', 'Transaksi berhasil disimpan melalui ' . ucfirst($request->payment_method) . '.');
    }

    public function qris(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        return response()->json([
            'success' => true,
            'payment_method' => 'qris',
            'amount' => (float) $request->amount,
            'qr_code' => '00020101021226580014ID.CO.QRIS.WWW0118QRIS-DEMO520400005303986540' . (int) $request->amount . '5802ID5913Merchant Test6007Bandung62140510ABC123',
            'message' => 'Silakan scan QRIS untuk menyelesaikan pembayaran.',
        ]);
    }
}
