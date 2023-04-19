<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\GuardianUser;
use App\Models\IdentityVerification;

class IdentityVerificationTest extends TestCase
{
    private static $isSetup = false;
    private static $guardian_user = array();
    private static $identity_verification = array();

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
        if(!self::$identity_verification){
            self::$identity_verification = IdentityVerification::where('guardian_user_id',self::$guardian_user->id)->get()->first();
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_identity_verification_all()
    {
        $response = $this->get('/api/admin/guardian/'.self::$guardian_user->id.'/identity_verification');
        $response->assertStatus(200);
    }

    public function test_identity_verification_post()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $response = $this->postJson('/api/admin/guardian/'.$guardian_id.'/identity_verification', [
            "guardian_user_id" => $guardian_id,
            "status" => 0,
            "memo" => "string",
            "title" => random_int(0,4),
            "request_at" => "2022-11-01 07:59:27",
            "expiration_on" => "2022-11-01",
            "additional_file_path" => "string"
        ]);
        $response->assertStatus(201);
    }
    public function test_identity_verification_put()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $identity_verification = self::$identity_verification->id;
        $response = $this->putJson('/api/admin/guardian/'.$guardian_id.'/identity_verification/'.$identity_verification, [
            "guardian_user_id" => $guardian_id,
            "status" => 0,
            "memo" => "test",
            "title" => random_int(0,5),
            "request_at" => "2022-07-16 12:53:00",
            "expiration_on" => "2023-02-03",
            "additional_file_path" => "/image/test.png"
        ]);

        $response->assertStatus(200);
    }
    public function test_identity_verification_delete()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $identity_verification = self::$identity_verification->id;
        $response = $this->delete('/api/admin/guardian/'.$guardian_id.'/identity_verification/'.$identity_verification);

        $response->assertStatus(200);
    }
}
