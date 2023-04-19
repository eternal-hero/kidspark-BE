<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\GuardianUser;
use App\Models\Point;

class PointTest extends TestCase
{
    private static $isSetup = false;
    private static $guardian_user = array();
    private static $point = array();

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
        if(!self::$point){
            self::$point = Point::where('guardian_user_id',self::$guardian_user->id)->get()->first();
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_point_all()
    {
        $response = $this->get('/api/admin/guardian/'.self::$guardian_user->id.'/points');
        $response->assertStatus(200);
    }

    public function test_point_post()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $response = $this->postJson('/api/admin/guardian/'.$guardian_id.'/points', [
            "guardian_user_id" => $guardian_id,
            "job_reservation_id" => 0,
            "content" => 0,
            "point" => 0,
            "point_on" => "2022-11-02"
        ]);
        $response->assertStatus(201);
    }
    public function test_point_get()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $point_id = self::$point->id;
        $response = $this->get('/api/admin/guardian/'.$guardian_id.'/points/'.$point_id);

        $response->assertStatus(200);
    }
    public function test_point_put()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $point_id = self::$point->id;
        $response = $this->putJson('/api/admin/guardian/'.$guardian_id.'/points/'.$point_id, [
            "guardian_user_id" => $guardian_id,
            "job_reservation_id" => random_int(0,99999),
            "content" => random_int(0,4),
            "point" => random_int(-50,50)*100,
            "point_on" => "2022-07-15"
        ]);

        $response->assertStatus(200);
    }
    public function test_point_delete()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $point_id = self::$point->id;
        $response = $this->delete('/api/admin/guardian/'.$guardian_id.'/points/'.$point_id);

        $response->assertStatus(200);
    }
}
