<?php

namespace Tests\Feature;

use App\Models\SupporterSettingsManagement;
use App\Models\SupporterSupport;
use App\Models\SupporterUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SupporterSupportTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_crud()
    {
        // データ準備
        $suporterUser = SupporterUser::factory()->create();
        $settingManagement = SupporterSettingsManagement::factory()->create();
        // Store
        $storeRoute = route('admin.supporter.support.index', ['supporter_user_id' => $suporterUser->id]);
        $response = $this->postJson($storeRoute, [
            "settings_id" => $settingManagement->id,
            "shooting_support" => 1,
            "acceptance_condition" => "text",
            "transportation_support" => 1,
            "early_response_lower_limit" => 6,
            "early_response_upper_limit" => 9,
            "nighttime_lower_limit" => 20,
            "nighttime_upper_limit" => 24,
            "overnight_care_lower_limit" => 0,
            "overnight_care_upper_limit" => 0,
            "is_sick_children_support" => 1,
            "is_handicaped_children_support" => 1,
            "lesson_support_bitflag" => 0,
            "is_cabinet_office_discount_coupon" => 1,
            "is_foreign_user_support" => 0,
            "is_handicapped_children_support" => 0
        ]);
        $response->assertStatus(200);
        $this->assertEquals($suporterUser->supporterSupport()->count(), 1);
        // Update
        $updateRoute = route('admin.supporter.support.update', ['supporter_user_id' => $suporterUser->id]);
        $response = $this->putJson($updateRoute, [
            "settings_id" => $settingManagement->id,
            "shooting_support" => 1,
            "acceptance_condition" => "text",
            "transportation_support" => 1,
            "early_response_lower_limit" => 6,
            "early_response_upper_limit" => 9,
            "nighttime_lower_limit" => 20,
            "nighttime_upper_limit" => 24,
            "overnight_care_lower_limit" => 0,
            "overnight_care_upper_limit" => 0,
            "is_sick_children_support" => 1,
            "is_handicaped_children_support" => 1,
            "lesson_support_bitflag" => 0,
            "is_cabinet_office_discount_coupon" => 1,
            "is_foreign_user_support" => 0,
            "is_handicapped_children_support" => 0
        ]);
        $response->assertStatus(200);
        // Get
        $indexRoute = route('admin.supporter.support.index', ['supporter_user_id' => $suporterUser->id]);
        $response = $this->get($indexRoute);
        $response->assertStatus(200);
        // Delete
        $deleteRoute = route('admin.supporter.support.delete', ['supporter_user_id' => $suporterUser->id]);
        $response = $this->delete($deleteRoute);
        $response->assertStatus(200);
        $this->assertEquals($suporterUser->supporterSupport()->count(), 0);
        // 要らないデータを削除
        $suporterUser->delete();
        $settingManagement->delete();
    }
}
