<?php

namespace Tests\Feature;

use App\Models\Saving;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SavingTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_dashboard_with_savings(): void
    {
        Saving::create([
            'name' => 'Dana Liburan',
            'target_amount' => 5000000,
            'current_amount' => 1500000,
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Dana Liburan');
        $response->assertSee('30%'); // 1.5jt / 5jt = 30%
    }

    public function test_can_store_new_saving(): void
    {
        $response = $this->post('/savings', [
            'name' => 'Beli Gadget',
            'target_amount' => 3000000,
            'current_amount' => 500000,
            'notes' => 'Tabungan hp baru',
        ]);

        $response->assertRedirect(route('savings.index'));
        $this->assertDatabaseHas('savings', [
            'name' => 'Beli Gadget',
            'target_amount' => 3000000,
        ]);
    }

    public function test_can_deposit_to_saving(): void
    {
        $saving = Saving::create([
            'name' => 'Dana Darurat',
            'target_amount' => 10000000,
            'current_amount' => 2000000,
        ]);

        $response = $this->patch("/savings/{$saving->id}", [
            'add_amount' => 1000000,
        ]);

        $response->assertRedirect(route('savings.index'));
        $this->assertEquals(3000000, $saving->fresh()->current_amount);
    }

    public function test_can_delete_saving(): void
    {
        $saving = Saving::create([
            'name' => 'Beli Buku',
            'target_amount' => 500000,
            'current_amount' => 100000,
        ]);

        $response = $this->delete("/savings/{$saving->id}");

        $response->assertRedirect(route('savings.index'));
        $this->assertDatabaseMissing('savings', [
            'id' => $saving->id,
        ]);
    }
}
