<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\GuardianUser;
use App\Models\PublishApplication;

class PublishApplicationTest extends TestCase
{
    private static $isSetup = false;
    private static $guardian_user = array();
    private static $publish_application = array();

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
            self::$guardian_user = GuardianUser::factory()->create();
            self::$isSetup = true;
        }
        if(!self::$publish_application){
            self::$publish_application = PublishApplication::where('guardian_user_id',self::$guardian_user->id)->get()->first();
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_publish_application_all()
    {
        $response = $this->get('/api/admin/guardian/'.self::$guardian_user->id.'/publish_applications');
        $response->assertStatus(200);
    }

    public function test_publish_application_post()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $response = $this->postJson('/api/admin/guardian/'.$guardian_id.'/publish_applications', [
            "guardian_user_id" => $guardian_id,
            "title" => "string",
            "type" => 0,
            "is_single" => 0,
            "childcare_on" => "2022-11-02",
            "support_time_start" => "00:00",
            "support_time_end" => "23:59",
            "detail" => "string",
            "fee_limit" => 0,
            "transportation_expenses_limit" => 0,
            "place" => "string",
            "near_station" => "string",
            "period_at" => "2022-11-02 02:38:03",
            "status" => 0
        ]);
        $response->assertStatus(201);
    }
    public function test_publish_application_get()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $publish_application_id = self::$publish_application->id;
        $response = $this->get('/api/admin/guardian/'.$guardian_id.'/publish_applications/'.$publish_application_id);

        $response->assertStatus(200);
    }
    public function test_publish_application_put()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $publish_application_id = self::$publish_application->id;
        $response = $this->putJson('/api/admin/guardian/'.$guardian_id.'/publish_applications/'.$publish_application_id, [
            "guardian_user_id" => $guardian_id,
            "title" => "テキストテキスト",
            "type" => 1,
            "is_single" => 0,
            "childcare_on" => "2022-08-10",
            "support_time_start" => "10:00",
            "support_time_end" => "12:00",
            "detail" => "テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト",
            "fee_limit" => -1,
            "transportation_expenses_limit" => -1,
            "place" => "台東区",
            "near_station" => "渋谷駅",
            "period_at" => "2022-07-01 15:00:00",
            "status" => 0
        ]);

        $response->assertStatus(200);
    }
    public function test_publish_application_delete()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $publish_application_id = self::$publish_application->id;
        $response = $this->delete('/api/admin/guardian/'.$guardian_id.'/publish_applications/'.$publish_application_id);

        $response->assertStatus(200);
    }
}
