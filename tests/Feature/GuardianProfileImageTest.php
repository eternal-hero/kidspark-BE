<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\GuardianUser;
use App\Models\GuardianProfile;
use App\Models\GuardianProfileImage;

class GuardianProfileImageTest extends TestCase
{
    private static $isSetup = false;

    private static $profile = array();
    private static $profile_image = array();

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        //Artisan::call("migrate:refresh");
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        //Artisan::call("migrate:rollback --step 1");
    }

    protected function setUp(): void
    {
        parent::setUp();
        if(self::$isSetup === false){
            $guardian_user = GuardianUser::factory()->create();
            self::$profile = GuardianProfile::factory()->relation_guardian_user($guardian_user->id)->create();
            self::$isSetup = true;
        }
        if(!self::$profile_image){
            self::$profile_image = GuardianProfileImage::where('guardian_profiles_id',self::$profile->id)->get()->first();
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_guardian_profiles_all()
    {
        $response = $this->get('/api/admin/guardian/'.self::$profile->id.'/profiles/images');
        $response->assertStatus(200);
    }

    public function test_guardian_profiles_post()
    {
        //$this->markTestSkipped();
        $profile_id = self::$profile->id;
        $response = $this->postJson('/api/admin/guardian/'.$profile_id.'/profiles/images', [
            "guardian_profiles_id" => $profile_id,
            "image_path" => "string",
            "which_image" => 0,
            "is_examination" => 0
        ]);
        $response->assertStatus(201);
    }

    public function test_guardian_profile_images_get()
    {
        //$this->markTestSkipped();
        $profile_id = self::$profile->id;
        $profile_image_id = self::$profile_image->id;
        $response = $this->get('/api/admin/guardian/'.$profile_id.'/profiles/images/'.$profile_image_id);

        $response->assertStatus(200);
    }

    public function test_guardian_profiles_put()
    {
        //$this->markTestSkipped();
        $profile_id = self::$profile->id;
        $profile_image_id = self::$profile_image->id;
        $response = $this->putJson('/api/admin/guardian/'.$profile_id.'/profiles/images/'.$profile_image_id, [
            "guardian_profiles_id" => $profile_id,
            "image_path" => "/image/test.png",
            "which_image" => random_int(0,2),
            "is_examination" => 1
        ]);

        $response->assertStatus(200);
    }
    public function test_guardian_profiles_delete()
    {
        //$this->markTestSkipped();
        $profile_id = self::$profile->id;
        $profile_image_id = self::$profile_image->id;
        $response = $this->delete('/api/admin/guardian/'.$profile_id.'/profiles/images/'.$profile_image_id);

        $response->assertStatus(200);
    }
}
