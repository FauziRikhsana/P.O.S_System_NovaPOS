<?php

use App\Models\User;
use Tests\TestCase;

describe('role-based views', function () {
    it('shows admin navigation for admin users', function () {
        /** @var TestCase $this */
        $admin = User::factory()->create([
            'name' => 'Admin Test',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertOk();
        $response->assertSee('Dashboard');
        $response->assertSee('Kategori');
        $response->assertSee('Produk');
        $response->assertSee('Supplier');
    });

    it('shows dedicated cashier dashboard for cashier users', function () {
        /** @var TestCase $this */
        $kasir = User::factory()->create([
            'name' => 'Kasir Test',
            'email' => 'kasir@example.com',
            'role' => 'kasir',
        ]);

        $response = $this->actingAs($kasir)->get('/kasir/dashboard');

        $response->assertOk();
        $response->assertSee('Dashboard Kasir');
        $response->assertSee('Transaksi Hari Ini');
    });

    it('shows cashier navigation for cashier users', function () {
        /** @var TestCase $this */
        $kasir = User::factory()->create([
            'name' => 'Kasir Test',
            'email' => 'kasir@example.com',
            'role' => 'kasir',
        ]);

        $response = $this->actingAs($kasir)->get('/sales');

        $response->assertOk();
        $response->assertSee('Penjualan');
        $response->assertDontSee('Dashboard');
        $response->assertDontSee('Kategori');
        $response->assertDontSee('Supplier');
        $response->assertDontSee('Admin Panel');
    });
});
