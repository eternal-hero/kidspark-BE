<?php

namespace Tests\Feature;

use App\Models\SupporterSettingsManagement;
use Tests\TestCase;

class SettingsManagementTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $item = SupporterSettingsManagement::factory()->create();
        $response = $this->get(route('admin.supporter.settings.management'));
        $response->assertStatus(200);

        $response = $this->get(route('admin.supporter.settings.management', ['id' => $item->id]));
        $response->assertStatus(200);
    }
}
