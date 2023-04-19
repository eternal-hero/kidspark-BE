<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin as Admin;
use App\Http\Controllers\Guardians as Guardians;
use App\Http\Controllers\Supporter as SupporterUser;
use App\Http\Controllers\BeforeLogin as BeforeLogin;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'before_login'],function(){
    Route::group(['prefix' => 'guardian'], function () {
        //保護者　仮ユーザー登録・認証メール送信
        Route::post('/tmp_user', [BeforeLogin\Guardian\TmpGuardianUserController::class, 'store']);
        //保護者　基本情報登録
        Route::put('/tmp_user', [BeforeLogin\Guardian\TmpGuardianUserController::class, 'update']);
        //保護者　メール認証
        Route::put('/tmp_user/email_verified', [BeforeLogin\Guardian\TmpGuardianUserController::class, 'verificationEmail']);
        //保護者　認証メール再送
        Route::put('/tmp_user/resend_auth_code', [BeforeLogin\Guardian\TmpGuardianUserController::class, 'resendAuthCode']);
        //保護者　本人確認書類・ユーザー登録
        Route::post('/user', [BeforeLogin\Guardian\GuardianUserController::class, 'store']);
    });
});

Route::group(['prefix' => 'admin'], function () {
    // Auth絡み
    Route::post('/auth/login', [Admin\AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum', 'abilities:' . config('auth.abillity_keys.authenticated_admin_user')]], function () {
        // 管理者認証必須API群
        require 'require_list/admin_api.php';
    });
});

Route::group(['prefix' => 'guardians'], function () {
    // Auth絡み
    Route::post('/auth/login', [Guardians\AuthController::class, 'login']);

    Route::group(['middleware' => ['auth:sanctum', 'abilities:' . config('auth.abillity_keys.authenticated_guardian_user')]], function () {
        // 保護者認証必須API群
        require 'require_list/guardians_api.php';
    });
});

Route::group(['prefix' => 'supporter'], function () {
    // Auth絡み
    Route::post('/auth/login', [SupporterUser\AuthController::class, 'login']);

    // サポーター認証必須API群
    Route::group(['middleware' => ['auth:sanctum', 'abilities:' . config('auth.abillity_keys.authenticated_supporter_user')]], function () {
        require 'require_list/supporter_api.php';
    });
});

