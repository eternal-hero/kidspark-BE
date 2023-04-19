<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guardians as Guardians;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\Common as Common;

Route::group(['prefix' => 'auth'], function () {
    // login_check 認証エラーはミドルウェア側で（ルーティングの前段）で、返されるため、このルーティングは、正常レスポンスを返すのみでOK
    Route::get('login_check', function () {
        return response()->ok();
    });
    /*logout*/
    Route::post('logout', [Guardians\AuthController::class, 'logout']);
});

Route::group(['prefix' => 'common', 'as' => 'common.'], function () {
    // Inoculation status
    // 管理者・保護者と共通処理
    Route::get('inoculation/{id?}', [Common\InoculationStatusController::class, 'index']);
    Route::put('inoculation/{id}', [Common\InoculationStatusController::class, 'update']);
    Route::post('inoculation/', [Common\InoculationStatusController::class, 'store']);
    Route::delete('inoculation/{id}', [Common\InoculationStatusController::class, 'destroy']);
});

//IDで保護者を習得する | Get a guardian by ID
Route::get('/', [Guardians\UserController::class, 'index']);
//保護者の情報を更新 | Update a guardian information by ID
Route::put('/', [Guardians\UserController::class, 'update']);
//保護者のパスワードを更新
Route::put('/password', [Guardians\UserController::class, 'update_password']);
//保護者情報を取得する | Get a guardian information by ID
Route::get('/profile', [Guardians\ProfileController::class, 'index']);
//保護者の情報を更新 | Update a guardian information by ID
Route::post('/profile', [Guardians\ProfileController::class, 'store']);
Route::put('/profile', [Guardians\ProfileController::class, 'update']);
//保護者のプロフィール写真を取得する
Route::get('/profiles/images', [Guardians\ProfileImageController::class, 'index']);
//保護者のプロフィール写真を一括更新
Route::put('/profiles/image_update_all', [Guardians\ProfileImageController::class, 'update_all']);
//保護者の子供たちの情報を取得
Route::get('/children', [Guardians\ChildController::class, 'index']);
//Store the information of a child
Route::post('/children', [Guardians\ChildController::class, 'store']);
//子供の情報を更新 | Update the information of a child
Route::put('/children/{children_id}', [Guardians\ChildController::class, 'update']);
//子供の情報を一括更新 | Update the information of all child
Route::put('/children_update_all', [Guardians\ChildController::class, 'update_all']);

Route::get('/jobs', [Guardians\JobController::class, 'index']);
Route::post('/jobs', [Guardians\JobController::class, 'store']);
Route::get('/jobs/{job_id}', [Guardians\JobController::class, 'search']);

Route::post('/jobs/{job_id}/refuse', [Guardians\JobController::class, 'refuse']);

Route::group(['prefix' => 'file', 'as' => 'file.'], function () {
    Route::post('/delete', [UploadFileController::class, 'delete']);
    Route::post('/{file_path_id}/upload', [UploadFileController::class, 'upload'])->middleware('assigment.file.path');
});
?>
