<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\SupporterUser;
use App\Models\SupporterExperience;

class SupporterExperienceTest extends TestCase
{
    private static $isSetup = false;
    private static $supporter_user = array();
    private static $supporter_experience = array();

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
        if(!self::$supporter_experience){
            self::$supporter_experience = SupporterExperience::where('supporter_user_id',self::$supporter_user->id)->get()->first();
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_supporter_experience_post()
    {
        $supporter_user_id = self::$supporter_user->id;
        $supporter_experience = SupporterExperience::factory()->relation_supporter_user($supporter_user_id)->make()->getAttributes();
        $response = $this->postJson('/api/admin/supporter/'.$supporter_user_id.'/settings/experience',$supporter_experience);
        $response->assertStatus(201);
    }
    public function test_supporter_experience_get()
    {
        //$this->markTestSkipped();
        $supporter_user_id = self::$supporter_user->id;
        $supporter_experience_id = self::$supporter_experience->id;
        $response = $this->get('/api/admin/supporter/'.$supporter_user_id.'/settings/experience/');

        $response->assertStatus(200);
    }
    public function test_supporter_experience_put()
    {
        //$this->markTestSkipped();
        $supporter_user_id = self::$supporter_user->id;
        $supporter_experience_id = self::$supporter_experience->id;
        $response = $this->putJson('/api/admin/supporter/'.$supporter_user_id.'/settings/experience', [
            'supporter_user_id' => $supporter_user_id,
            'parenting_experience' => 1
        ]);

        $response->assertStatus(200);
    }
    public function test_supporter_experience_delete()
    {
        //$this->markTestSkipped();
        $supporter_user_id = self::$supporter_user->id;
        $supporter_experience_id = self::$supporter_experience->id;
        $response = $this->delete('/api/admin/supporter/'.$supporter_user_id.'/settings/experience/');

        $response->assertStatus(200);
    }
}
