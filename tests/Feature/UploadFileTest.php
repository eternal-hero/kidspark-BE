<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadFileTest extends TestCase
{

    private static $file_name;
    private static $file_path;

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
        if(!self::$file_name){
            self::$file_name = 'test_'.date("Ymd-His").'.jpg';
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_upload_file()
    {
        //$this->markTestSkipped();
        Storage::fake('public');
        $file_path_id = 'test';//test用
        $file = UploadedFile::fake()->create(self::$file_name);
        $response = $this->postJson('/api/admin/file/'.$file_path_id.'/upload', [
            'file' => $file
        ]);
        $responce_contents = json_decode($response->content());//レスポンス取得
        $path_array = config('api.uploadfile.supporter_setting_type');
        self::$file_path = $responce_contents->data;
        Storage::disk('local')->assertExists(self::$file_path);
    }

    public function test_delete_file()
    {
        //$this->markTestSkipped();
        $file_path_id = 'test';//test用
        if(!self::$file_path){
            //ダミーファイル作成
            Storage::fake('public');
            $file = UploadedFile::fake()->create(self::$file_name);
            $response = $this->postJson('/api/admin/file/'.$file_path_id.'/upload', [
                'file' => $file
            ]);
            $responce_contents = json_decode($response->content());
            self::$file_path = $responce_contents->data;
        }

        $response = $this->postJson('/api/admin/file/delete', [
            'delete_path' => self::$file_path
        ]);
        $responce_contents = json_decode($response->content());//レスポンス取得
        $response->assertStatus(200);
    }
}
