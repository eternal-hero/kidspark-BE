<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\GuardianUser;
use App\Models\GuardianNotice;

class GuardianNoticeTest extends TestCase
{
    private static $isSetup = false;
    private static $guardian_user = array();
    private static $guardian_notices = array();

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
        if(!self::$guardian_notices){
            self::$guardian_notices = GuardianNotice::where('guardian_user_id',self::$guardian_user->id)->get()->first();
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_guardian_notices_all()
    {
        $response = $this->get('/api/admin/guardian/'.self::$guardian_user->id.'/notices');
        $response->assertStatus(200);
    }

    public function test_guardian_notices_post()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $response = $this->postJson('/api/admin/guardian/'.$guardian_id.'/notices', [
            "guardian_user_id" => $guardian_id,
            "is_reserve" => 0,
            "is_bbs" => 0,
            "is_message" => 0,
            "is_kidspark" => 0
        ]);
        $response->assertStatus(201);
    }
    public function test_guardian_notices_put()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $guardian_notices_id = self::$guardian_notices->id;
        $response = $this->putJson('/api/admin/guardian/'.$guardian_id.'/notices/'.$guardian_notices_id, [
            "guardian_user_id" => $guardian_id,
            "is_reserve" => random_int(0,1),
            "is_bbs" => random_int(0,1),
            "is_message" => random_int(0,1),
            "is_kidspark" => random_int(0,1)
        ]);

        $response->assertStatus(200);
    }
    public function test_guardian_notices_delete()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $guardian_notices_id = self::$guardian_notices->id;
        $response = $this->delete('/api/admin/guardian/'.$guardian_id.'/notices/'.$guardian_notices_id);

        $response->assertStatus(200);
    }
}
