<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_kasir_can_store_sale_with_json_items(): void
    {
        $user = User::factory()->create(['role' => 'kasir']);
        $category = Category::create(['name' => 'Makanan']);
        $supplier = Supplier::create([
            'name' => 'Supplier A',
            'phone' => '0812',
            'email' => 'supplier@example.com',
            'address' => 'Bandung',
        ]);
        $product = Product::create([
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'barcode' => 'POS000001',
            'name' => 'Es Teh',
            'stock' => 10,
            'purchase_price' => 3000,
            'selling_price' => 5000,
        ]);

        $response = $this->actingAs($user)->post('/sales', [
            'items' => json_encode([
                ['product_id' => $product->id, 'qty' => 2],
            ]),
            'payment_method' => 'qris',
            'paid' => 10000,
        ]);

        $response->assertRedirect('/sales');
        $this->assertDatabaseHas('sales', ['invoice' => 'INV-' . now()->format('YmdHis')]);
    }
}
