<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategorySelectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_category_from_predefined_options(): void
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->post('/categories', [
            'name' => 'Makanan',
        ]);

        $response->assertRedirect('/categories');
        $this->assertDatabaseHas('categories', ['name' => 'Makanan']);
    }

    public function test_admin_cannot_create_category_with_manual_name(): void
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->post('/categories', [
            'name' => 'Kategori Baru',
        ]);

        $response->assertSessionHasErrors('name');
    }
}
