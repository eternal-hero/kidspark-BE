<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\GuardianUser;

class GuardianUserTest extends TestCase
{
    private static $isSetup = false;
    private static $guardian_user = array();

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
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_guardian_users_get_all()
    {
        $response = $this->get('/api/admin/guardian/');

        $response->assertStatus(200);
    }

    public function test_guardian_users_post()
    {
        $response = $this->postJson('/api/admin/guardian/', [
            "first_name" => "string",
            "last_name" => "string",
            "first_kana" => "string",
            "last_kana" => "string",
            "nickname" => "string",
            "gender" =>  0,
            "relation" =>  "string",
            "birthday" =>  "2022-10-31",
            "post_code" =>  "string",
            "prefecture" =>  "string",
            "municipality" =>  "string",
            "street_name" =>  "string",
            "building" =>  "string",
            "contact_phone_number" =>  "string",
            "mail_address" =>  "user@example.com",
            "password" =>  "string",
            "workspace" =>  "string",
            "family_structure" =>  "string",
            "is_pets" =>  0,
            "housing_type" =>  "string",
            "is_camera" =>  0,
            "emergency_contact_name" => "string",
            "emergency_contact_phone_number" => "string",
            "emergency_contact_relation" => "string",
            "status" =>  0
        ]);

        $response
            ->assertStatus(201);
    }
    public function test_guardian_users_get()
    {
        $response = $this->get('/api/admin/guardian/'.self::$guardian_user->id);

        $response->assertStatus(200);
    }
    public function test_guardian_users_put()
    {
        $response = $this->putJson('/api/admin/guardian/'.self::$guardian_user->id, [
            "first_name" => "花子",
            "last_name" => "佐藤",
            "first_kana" => "はなこ",
            "last_kana" => "さとう",
            "nickname" => "花まま",
            "gender" =>  0,
            "relation" =>  "母",
            "birthday" =>  "1990-07-16",
            "post_code" =>  "8100001",
            "prefecture" =>  "福岡県",
            "municipality" =>  "福岡市中央区天神",
            "street_name" =>  "3-1-1",
            "building" =>  "山田ビル5F",
            "contact_phone_number" =>  "0901234567",
            "mail_address" =>  "sample@sample.com",
            //"password" =>  "test",
            "workspace" =>  "株式会社タナカヤ",
            "family_structure" =>  "父，母，子",
            "is_pets" =>  1,
            "housing_type" =>  "マンション",
            "is_camera" =>  1,
            "emergency_contact_name" => "佐藤 一郎",
            "emergency_contact_phone_number" => "0901234567",
            "emergency_contact_relation" => "夫",
            "status" =>  0
        ]);

        $response
            ->assertStatus(200);
    }
    public function test_guardian_user_password_put()
    {
        $response = $this->putJson('/api/admin/guardian/'.self::$guardian_user->id.'/password', [
            "password" =>  "test",
        ]);

        $response
            ->assertStatus(200);
    }
    public function test_guardian_user_password_get()
    {
        $response = $this->get('/api/admin/guardian/'.self::$guardian_user->id.'/password');

        $response->assertStatus(200);
    }
    public function test_guardian_users_delete()
    {
        $response = $this->delete('/api/admin/guardian/'.self::$guardian_user->id);

        $response
            ->assertStatus(200);
    }
}
