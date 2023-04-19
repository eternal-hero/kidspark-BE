<?php

use App\Models\SupporterUser;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class SupportAreaTest extends TestCase
{
    public function test_crud()
    {
        $supporterUser = SupporterUser::factory()->create();
        // Store
        $storeRoute = route('admin.supporter.support_area.index', ['supporter_user_id' => $supporterUser->id]);
        for ($i = 0; $i < 2; $i++) {
            $response = $this->postJson($storeRoute, [
                "prefecture" => 12,
                "area" => "港区,渋谷区,世田谷区"
            ]);
        }

        $supportAreaId = $response['data']['id'];
        $response->assertStatus(200);
        // Update
        $updateRoute = route('admin.supporter.support_area.update', ['supporter_user_id' => $supporterUser->id, 'support_area_id' => $supportAreaId]);
        $response = $this->putJson($updateRoute, [
            "prefecture" => 13,
            "area" => "世田谷区"
        ]);
        $response->assertStatus(200);
        // Get - 1つ
        $indexRoute = route('admin.supporter.support_area.index', ['supporter_user_id' => $supporterUser->id, 'support_area_id' => $supportAreaId]);
        $this->get($indexRoute)->assertStatus(200);
        // Get - 全部
        $indexRoute = route('admin.supporter.support_area.index', ['supporter_user_id' => $supporterUser->id]);
        $this->get($indexRoute)->assertStatus(200);
        // Delete　- 1つ
        $supportAreaCount = $supporterUser->supportAreas()->count();
        $deleteRoute = route('admin.supporter.support_area.delete', ['supporter_user_id' => $supporterUser->id, 'support_area_id' => $supportAreaId]);
        $response = $this->delete($deleteRoute);
        $response->assertStatus(200);
        $supportAreaCountAfterDelete = $supporterUser->supportAreas()->count();
        $this->assertEquals($supportAreaCount - 1, $supportAreaCountAfterDelete);
        // Delete - 全部
        $deleteRoute = route('admin.supporter.support_area.delete', ['supporter_user_id' => $supporterUser->id]);
        $response = $this->delete($deleteRoute);
        $response->assertStatus(200);
        $this->assertEquals($supporterUser->supportAreas()->count(), 0);
        $supporterUser->delete();
    }
}
