<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReportExportTest extends TestCase
{
    use RefreshDatabase;

    public function test_shows_the_report_page_for_an_admin_user(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->actingAs($user)
            ->get('/reports')
            ->assertOk();
    }

    public function test_downloads_a_pdf_report_for_an_admin_user(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)
            ->get('/reports/export/pdf');

        $response->assertOk()
            ->assertHeader('content-type', 'application/pdf');
    }

    public function test_downloads_an_excel_report_for_an_admin_user(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)
            ->get('/reports/export/excel');

        $response->assertOk()
            ->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }
}
