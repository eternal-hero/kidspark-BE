<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\GuardianUser;
use App\Models\GuardianProfile;

class GuardianProfileTest extends TestCase
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

    public function test_guardian_profiles_all()
    {
        $response = $this->get('/api/admin/guardian/'.self::$guardian_user->id.'/profiles');
        $response->assertStatus(200);
    }

    public function test_guardian_profiles_post()
    {
        $guardian_id = self::$guardian_user->id;
        $response = $this->postJson('/api/admin/guardian/'.$guardian_id.'/profiles', [
            "guardian_user_id" => $guardian_id,
            "inoculation_status_id" => 0,
            "title" => "string",
            "self_introduction" => "string",
            "near_line" => "string",
            "near_station" => "string",
            "means" => 0,
            "travel_time" => 0,
            "is_publish" => 0,
            "rule" => "string"
        ]);
        $response->assertStatus(201);
    }
    public function test_guardian_profiles_put()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $response = $this->putJson('/api/admin/guardian/'.$guardian_id.'/profiles', [
            "guardian_user_id" => $guardian_id,
            "inoculation_status_id" => 0,
            "title" => "笑顔で明るく！それぞれのご家庭に寄り添った楽しい保育を。",
            "self_introduction" => "２００５年からは子育てをしながら、ベビーサイン講師として活動をしていました。アロマセラピストとしても、赤ちゃんや幼児、小学生へのタッチケアを行っています。ベビーサインやタッチケアも発達障害を持つお子様にもそうでないお子様にも、とても大切なことだということが近年の研究結果で分かりつつある今、どんな子供にも1人1人対応できるように学びは続いています。",
            "near_line" => "西部有楽町",
            "near_station" => "新桜台",
            "means" => 0,
            "travel_time" => 15,
            "is_publish" => 1,
            "rule" => "昼間はテレビを見ない。"
        ]);

        $response->assertStatus(200);
    }
    public function test_guardian_profiles_delete()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $response = $this->delete('/api/admin/guardian/'.$guardian_id.'/profiles/');

        $response->assertStatus(200);
    }
}
