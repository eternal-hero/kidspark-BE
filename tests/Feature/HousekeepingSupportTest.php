<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\SupporterUser;
use App\Models\HousekeepingSupport;
use App\Libs\SupporterSettingType;

class HousekeepingSupportTest extends TestCase
{
    private static $isSetup = false;
    private static $supporter_user = array();
    private static $housekeeping_support = array();

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
    }

    protected function setUp(): void
    {
        parent::setUp();
        if(self::$isSetup === false){
            self::$supporter_user = SupporterUser::factory()->create();
            self::$isSetup = true;
        }
        if(!self::$housekeeping_support){
            self::$housekeeping_support = HousekeepingSupport::where('supporter_user_id',self::$supporter_user->id)->get()->first();
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_housekeeping_support_post()
    {
        $supporter_user_id = self::$supporter_user->id;
        $housekeeping_support = HousekeepingSupport::factory()->relation_supporter_user($supporter_user_id)->make()->getAttributes();
        $response = $this->postJson('/api/admin/supporter/'.$supporter_user_id.'/housekeeping/supports',$housekeeping_support);
        $response->assertStatus(201);
    }
    public function test_housekeeping_support_get()
    {
        //$this->markTestSkipped();
        $supporter_user_id = self::$supporter_user->id;
        $housekeeping_support_id = self::$housekeeping_support->id;
        $response = $this->get('/api/admin/supporter/'.$supporter_user_id.'/housekeeping/supports');

        $response->assertStatus(200);
    }
    public function test_housekeeping_support_put()
    {
        //$this->markTestSkipped();
        $supporter_user_id = self::$supporter_user->id;
        $housekeeping_support_id = self::$housekeeping_support->id;
        $setting_type = SupporterSettingType::getSupporterSettingType();
        $response = $this->putJson('/api/admin/supporter/'.$supporter_user_id.'/housekeeping/supports', [
            'settings_id' => $setting_type[array_search(config('api.supporter.supporter_setting_type.housekeeping'),array_column($setting_type,'name'))]['id'],
            'supporter_user_id' => $supporter_user_id,
            'shooting_support' => 1,
            'acceptance_condition' => "・より多くのリクエストにお応えできるよう、サポーター自宅から1時間以内の方を優先でお引き受けしております。\n基本は、自家用車での移動となっております。\n1kmあたり30円換算で交通費を頂戴致します。\nまた片道1時間以上の場合は高速道路代(600円～)を頂戴いたします。\n\n・駐車場に関しては、コインパーキングを使用する場合は、利用時間分を頂戴致します。",
            'room_cleaning_bitflag' => 0b1111,
            'water_cleaning_bitflag' => 0b111
        ]);

        $response->assertStatus(200);
    }
    public function test_housekeeping_support_delete()
    {
        //$this->markTestSkipped();
        $supporter_user_id = self::$supporter_user->id;
        $housekeeping_support_id = self::$housekeeping_support->id;
        $response = $this->delete('/api/admin/supporter/'.$supporter_user_id.'/housekeeping/supports');

        $response->assertStatus(200);
    }
}
