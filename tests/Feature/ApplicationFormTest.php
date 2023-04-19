<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\GuardianUser;
use App\Models\ApplicationForm;
use HttpResponseStatus;

class ApplicationFormTest extends TestCase
{
    private static $isSetup = false;
    private static $guardian_user = array();
    private static $application_form = array();

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
        if(!self::$application_form){
            self::$application_form = ApplicationForm::where('guardian_user_id',self::$guardian_user->id)->get()->first();
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_application_form_all()
    {
        $response = $this->get('/api/admin/guardian/'.self::$guardian_user->id.'/application_forms');
        $response->assertStatus(200);
    }

    public function test_application_form_post()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $response = $this->postJson('/api/admin/guardian/'.$guardian_id.'/application_forms', [
            "guardian_user_id" => $guardian_id,
            "status" => 0,
            "memo" => "string",
            "updated_at" => "2022-11-02",
            "subject" => "string",
            'sender' => "string",
            'member_id' => 0,
            "detail" => "string",
            "file_path" => "string"
        ]);
        $response
            ->assertStatus(201);
    }
    public function test_application_form_get()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $application_form_id = self::$application_form->id;
        $response = $this->get('/api/admin/guardian/'.$guardian_id.'/application_forms/'.$application_form_id);

        $response->assertStatus(200);
    }
    public function test_application_form_put()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $application_form_id = self::$application_form->id;
        $response = $this->putJson('/api/admin/guardian/'.$guardian_id.'/application_forms/'.$application_form_id, [
            "guardian_user_id" => $guardian_id,
            "status" => random_int(-1,1),
            "memo" => "test",
            "updated_at" => "2023-02-03",
            "subject" => "申請",
            'sender' => "高升　良子",
            'member_id' => 123456,
            "detail" => "testtesttest",
            "file_path" => "/image/test.png"
        ]);

        $response
            ->assertStatus(200);
    }
    public function test_application_form_delete()
    {
        //$this->markTestSkipped();
        $guardian_id = self::$guardian_user->id;
        $application_form_id = self::$application_form->id;
        $response = $this->delete('/api/admin/guardian/'.$guardian_id.'/application_forms/'.$application_form_id);

        $response
            ->assertStatus(200);
    }
}
