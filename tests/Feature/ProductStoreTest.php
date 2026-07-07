<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_store_product_with_valid_data(): void
    {
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::create(['name' => 'Makanan']);
        $supplier = Supplier::create([
            'name' => 'Supplier A',
            'phone' => '0812',
            'email' => 'supplier@example.com',
            'address' => 'Bandung',
        ]);

        $response = $this->actingAs($user)->post('/products', [
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
            'name' => 'Produk Test',
            'stock' => 10,
            'purchase_price' => 5000,
            'selling_price' => 7500,
        ]);

        $response->assertRedirect('/products');
        $this->assertDatabaseHas('products', ['name' => 'Produk Test']);
    }
}
