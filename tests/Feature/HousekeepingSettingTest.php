<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\SupporterUser;
use App\Models\HousekeepingSetting;
use App\Libs\SupporterSettingType;

class HousekeepingSettingTest extends TestCase
{
    private static $isSetup = false;
    private static $supporter_user = array();
    private static $housekeeping_setting = array();

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
        if(!self::$housekeeping_setting){
            self::$housekeeping_setting = HousekeepingSetting::where('supporter_user_id',self::$supporter_user->id)->get()->first();
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_housekeeping_setting_post()
    {
        $supporter_user_id = self::$supporter_user->id;
        $housekeeping_setting = HousekeepingSetting::factory()->relation_supporter_user($supporter_user_id)->make()->getAttributes();
        $response = $this->postJson('/api/admin/supporter/'.$supporter_user_id.'/housekeeping',$housekeeping_setting);
        $response->assertStatus(201);
    }
    public function test_housekeeping_setting_get()
    {
        //$this->markTestSkipped();
        $supporter_user_id = self::$supporter_user->id;
        $housekeeping_setting_id = self::$housekeeping_setting->id;
        $response = $this->get('/api/admin/supporter/'.$supporter_user_id.'/housekeeping/');

        $response->assertStatus(200);
    }
    public function test_housekeeping_setting_put()
    {
        //$this->markTestSkipped();
        $supporter_user_id = self::$supporter_user->id;
        $housekeeping_setting_id = self::$housekeeping_setting->id;
        $setting_type = SupporterSettingType::getSupporterSettingType();
        $response = $this->putJson('/api/admin/supporter/'.$supporter_user_id.'/housekeeping', [
            'settings_id' => $setting_type[array_search(config('api.supporter.supporter_setting_type.housekeeping'),array_column($setting_type,'name'))]['id'],
            'supporter_user_id' => $supporter_user_id,
            'is_housework' => 1,
            'single_fee' => 1500,
            'regular_fee' => 1400,
            'special' => "・お子様の誕生月にご予約頂いた方は時給100円引きさせて頂きます。お子様の誕生日を証明できるの物（保険証、母子手帳など）のご提示をお願いいたします。\n・サポート完了後から48時間以内に次のご予約をして頂いた方は時給100円引きさせて頂きます。",
            'service' => "[提供可能なサービス]\n・新生児～15歳までの保育\n・沐浴、入浴補助\n・定期サポート\n・家庭教師\nなど、ご希望に応じて柔軟に対応いたします。\n時間帯も相談に応じます。\n泊まり保育も相談に応じます。\n\n[保育のときに心がけていること]\n安心して依頼していただけるよう、サポートは安全を最優先することはもちろんですが、こどもと親御さんの気持ちに寄り添う保育をモットーに保育しています。\nお子様を尊重し、自己肯定感を高め\n自主性を大切にサポートを心がけています。\nお子様が大好きですので、いつも楽しく笑顔にサポートしてまいります。すぐに仲良くなれます。"
        ]);

        $response->assertStatus(200);
    }
    public function test_housekeeping_setting_delete()
    {
        //$this->markTestSkipped();
        $supporter_user_id = self::$supporter_user->id;
        $housekeeping_setting_id = self::$housekeeping_setting->id;
        $response = $this->delete('/api/admin/supporter/'.$supporter_user_id.'/housekeeping/');

        $response->assertStatus(200);
    }
}
