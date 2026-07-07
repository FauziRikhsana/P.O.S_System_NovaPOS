<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'supplier'])->latest()->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('products.create', compact('categories', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048'
        ]);

        $image = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('products', 'public');
        }

        $lastProduct = Product::latest('id')->first();
        $nextNumber = $lastProduct ? $lastProduct->id + 1 : 1;
        $barcode = 'POS' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

        Product::create([
            'category_id' => (int) $request->category_id,
            'supplier_id' => (int) $request->supplier_id,
            'barcode' => $barcode,
            'name' => trim($request->name),
            'stock' => (int) $request->stock,
            'purchase_price' => (float) $request->purchase_price,
            'selling_price' => (float) $request->selling_price,
            'image' => $image,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'supplier_id' => 'required',
            'name' => 'required',
            'stock' => 'required|integer',
            'purchase_price' => 'required',
            'selling_price' => 'required',
            'image' => 'nullable|image',
        ]);

        $data = [
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'name' => $request->name,
            'stock' => $request->stock,
            'purchase_price' => $request->purchase_price,
            'selling_price' => $request->selling_price,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->fill($data);
        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
