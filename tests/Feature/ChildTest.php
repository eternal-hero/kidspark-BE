<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\GuardianUser;
use App\Models\Child;

class ChildTest extends TestCase
{
    private static $isSetup = false;
    private static $guardian_user = array();
    private static $child = array();

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
        if(!self::$child){
            self::$child = Child::where('guardian_user_id',self::$guardian_user->id)->get()->first();
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_children_all()
    {
        $response = $this->get('/api/admin/guardian/'.self::$guardian_user->id.'/children');
        $response->assertStatus(200);
    }

    public function test_children_post()
    {
        $guardian_id = self::$guardian_user->id;
        $response = $this->postJson('/api/admin/guardian/'.$guardian_id.'/children', [
            "guardian_user_id" => $guardian_id,
            "first_name" => "string",
            "last_name" => "string",
            "first_kana" => "string",
            "last_kana" => "string",
            "gender" => 0,
            "nickname" => "string",
            "birthday" => "2022-10-31",
            "allergy" => "string",
            "chronic_disease" => "string",
            "other" => "string"
        ]);
        $response->assertStatus(201);
    }
    public function test_children_get()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $child_id = self::$child->id;
        $response = $this->get('/api/admin/guardian/'.$guardian_id.'/children/'.$child_id);

        $response->assertStatus(200);
    }
    public function test_children_put()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $child_id = self::$child->id;
        $response = $this->putJson('/api/admin/guardian/'.$guardian_id.'/children/'.$child_id, [
            "guardian_user_id" => $guardian_id,
            "first_name" => "日奈子",
            "last_name" => "佐藤",
            "first_kana" => "ひなこ",
            "last_kana" => "さとう",
            "gender" => 0,
            "nickname" => "ひなちゃん",
            "birthday" => "2021-02-02",
            "allergy" => "牛乳",
            "chronic_disease" => "なし",
            "other" => "なんでも口に入れるので、おもちゃなどを飲み込まないように注意が必要です。"
        ]);

        $response->assertStatus(200);
    }
    public function test_children_delete()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $child_id = self::$child->id;
        $response = $this->delete('/api/admin/guardian/'.$guardian_id.'/children/'.$child_id);

        $response->assertStatus(200);
    }
}
