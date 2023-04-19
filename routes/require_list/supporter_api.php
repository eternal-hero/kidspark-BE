<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\Supporter as SupporterUser;
use App\Http\Controllers\Common as Common;

Route::group(['prefix' => 'auth'], function () {
    // login_check 認証エラーはミドルウェア側で（ルーティングの前段）で、返されるため、このルーティングは、正常レスポンスを返すのみでOK
    Route::get('login_check', function () {
        return response()->ok();
    });
    /*logout*/
    Route::post('logout', [SupporterUser\AuthController::class, 'logout']);
});

/*common*/
Route::group(['prefix' => 'common', 'as' => 'common.'], function () {
    // Inoculation status
    // 管理者・保護者と共通処理
    Route::get('inoculation/{id?}', [Common\InoculationStatusController::class, 'index']);
    Route::put('inoculation/{id}', [Common\InoculationStatusController::class, 'update']);
    Route::post('inoculation/', [Common\InoculationStatusController::class, 'store']);
    Route::delete('inoculation/{id}', [Common\InoculationStatusController::class, 'destroy']);
});
// Supporter_user
Route::get('/', [SupporterUser\UserController::class, 'index']);
Route::put('/', [SupporterUser\UserController::class, 'update']);
Route::get('/identification', [SupporterUser\UserController::class, 'identification']);
Route::put('/update-avatar', [SupporterUser\UserController::class, 'updateAvatar']);
// Supporter_user_password
Route::put('/password', [SupporterUser\UserController::class, 'update_password']);
// Profile
Route::get('/profiles', [SupporterUser\ProfileController::class, 'index']);
Route::put('/profiles', [SupporterUser\ProfileController::class, 'update']);
// Support area
Route::get('/support_area/{support_area_id?}', [SupporterUser\SupportAreaController::class, 'index'])->name('support_area.index');
Route::post('/support_area', [SupporterUser\SupportAreaController::class, 'store'])->name('support_area.store');
Route::put('/support_area/{support_area_id}', [SupporterUser\SupportAreaController::class, 'update'])->name('support_area.update');
Route::delete('/support_area/{support_area_id?}', [SupporterUser\SupportAreaController::class, 'delete'])->name('support_area.delete');
Route::post('/support_area_all', [SupporterUser\SupportAreaController::class, 'update_all']);
//PreInterviewSetting
Route::get('/pre_interview', [SupporterUser\PreInterviewSettingController::class, 'index']);
Route::post('/pre_interview', [SupporterUser\PreInterviewSettingController::class, 'store']);
Route::put('/pre_interview', [SupporterUser\PreInterviewSettingController::class, 'update']);
Route::delete('/pre_interview', [SupporterUser\PreInterviewSettingController::class, 'destroy']);
// Supporter_settings
Route::get('/settings', [SupporterUser\SettingController::class, 'index']);
Route::put('/settings', [SupporterUser\SettingController::class, 'update']);
Route::post('/settings', [SupporterUser\SettingController::class, 'store']);
Route::delete('/settings', [SupporterUser\SettingController::class, 'delete']);
// Supporter_options
Route::get('/settings/options', [SupporterUser\Setting\OptionController::class, 'index']);
Route::post('/settings/options', [SupporterUser\Setting\OptionController::class, 'store']);
Route::put('/settings/options/{option_id}', [SupporterUser\Setting\OptionController::class, 'update']);
Route::delete('/settings/options/{option_id}', [SupporterUser\Setting\OptionController::class, 'destroy']);
Route::put('/settings/options_all', [SupporterUser\Setting\OptionController::class, 'update_all']);
// Supporter support
Route::get('/settings/supports', [SupporterUser\Setting\SupportController::class, 'index'])->name('support.index');
Route::post('/settings/supports', [SupporterUser\Setting\SupportController::class, 'store'])->name('support.store');
Route::put('/settings/supports', [SupporterUser\Setting\SupportController::class, 'update'])->name('support.update');
Route::delete('/settings/supports', [SupporterUser\Setting\SupportController::class, 'delete'])->name('support.delete');
// //supporter_experience
Route::get('/settings/experience', [SupporterUser\Setting\ExperienceController::class, 'show']);
Route::post('/settings/experience', [SupporterUser\Setting\ExperienceController::class, 'store']);
Route::put('/settings/experience', [SupporterUser\Setting\ExperienceController::class, 'update']);
Route::delete('/settings/experience', [SupporterUser\Setting\ExperienceController::class, 'destroy']);
// childbirth_care_settings
Route::get('/childbirth_care/settings', [SupporterUser\ChildbirthCare\SettingController::class, 'show']);
Route::put('/childbirth_care/settings', [SupporterUser\ChildbirthCare\SettingController::class, 'update']);
Route::post('/childbirth_care/settings', [SupporterUser\ChildbirthCare\SettingController::class, 'store']);
Route::delete('/childbirth_care/settings', [SupporterUser\ChildbirthCare\SettingController::class, 'delete']);
// sick_child_care_settings
Route::get('/sick_child_care/settings', [SupporterUser\SickChildCare\SettingController::class, 'show']);
Route::put('/sick_child_care/settings', [SupporterUser\SickChildCare\SettingController::class, 'update']);
Route::post('/sick_child_care/settings', [SupporterUser\SickChildCare\SettingController::class, 'store']);
Route::delete('/sick_child_care/settings', [SupporterUser\SickChildCare\SettingController::class, 'delete']);
//housekeeping_settings
Route::get('/housekeeping', [SupporterUser\Housekeeping\SettingController::class, 'show']);
Route::post('/housekeeping', [SupporterUser\Housekeeping\SettingController::class, 'store']);
Route::put('/housekeeping', [SupporterUser\Housekeeping\SettingController::class, 'update']);
Route::delete('/housekeeping', [SupporterUser\Housekeeping\SettingController::class, 'destroy']);
//housekeeping_supports
Route::get('/housekeeping/supports', [SupporterUser\Housekeeping\SupportController::class, 'show']);
Route::post('/housekeeping/supports', [SupporterUser\Housekeeping\SupportController::class, 'store']);
Route::put('/housekeeping/supports', [SupporterUser\Housekeeping\SupportController::class, 'update']);
Route::delete('/housekeeping/supports', [SupporterUser\Housekeeping\SupportController::class, 'destroy']);
//works_image
Route::get('/works_images', [SupporterUser\WorkImageController::class, 'index']);
Route::post('/works_images', [SupporterUser\WorkImageController::class, 'store']);
Route::get('/works_images/{works_image_id?}', [SupporterUser\WorkImageController::class, 'show']);
Route::put('/works_images/{works_image_id}', [SupporterUser\WorkImageController::class, 'update']);
Route::delete('/works_images/{works_image_id?}', [SupporterUser\WorkImageController::class, 'destroy']);
Route::post('/works_images_all', [SupporterUser\WorkImageController::class, 'update_all']);
// Application document
Route::get('/application/documents/', [SupporterUser\Application\DocumentController::class, 'index']);
Route::get('/application/documents/{application_document_id?}', [SupporterUser\Application\DocumentController::class, 'show']);
Route::put('/application/documents/{application_document_id}', [SupporterUser\Application\DocumentController::class, 'update']);
Route::post('/application/documents/', [SupporterUser\Application\DocumentController::class, 'store']);
Route::delete('/application/documents/{application_document_id?}', [SupporterUser\Application\DocumentController::class, 'destroy']);
Route::post('/upload', [UploadFileController::class, 'store']);

Route::post('/upload', [UploadFileController::class, 'store']);

Route::get('/jobs', [SupporterUser\JobController::class, 'index']);
Route::get('/jobs/{job_id}', [SupporterUser\JobController::class, 'detail']);
Route::get('/jobs/{job_id}/options', [SupporterUser\JobController::class, 'options']);
Route::post('/jobs/{job_id}/refuse', [SupporterUser\JobController::class, 'refuse']);
Route::post('/jobs/{job_id}/cancel', [SupporterUser\JobController::class, 'cancel']);

Route::post('/jobs/{job_id}/status/ready',[SupporterUser\JobController::class, 'ready']);
Route::post('/jobs/{job_id}/status/start',[SupporterUser\JobController::class, 'start']);
Route::post('/jobs/{job_id}/status/end',[SupporterUser\JobController::class, 'end']);

Route::post('/jobs/{job_id}/estimate', [SupporterUser\EstimateController::class, 'store']);
Route::get('/jobs/{job_id}/estimate', [SupporterUser\EstimateController::class, 'show']);
Route::put('/jobs/{job_id}/estimate', [SupporterUser\EstimateController::class, 'update']);

Route::post('/jobs/{job_id}/report', [SupporterUser\ReportController::class, 'store']);
Route::get('/jobs/{job_id}/report', [SupporterUser\ReportController::class, 'show']);
Route::put('/jobs/{job_id}/report', [SupporterUser\ReportController::class, 'update']);

Route::post('/jobs/{job_id}/meeting_report', [SupporterUser\ReportController::class, 'meeting_store']);
Route::get('/jobs/{job_id}/meeting_report', [SupporterUser\ReportController::class, 'meeting_show']);
Route::put('/jobs/{job_id}/meeting_report', [SupporterUser\ReportController::class, 'meeting_update']);

Route::get('/reviews', [SupporterUser\ReviewController::class, 'index']);

Route::get('/schedule', [SupporterUser\ScheduleController::class, 'index']);
Route::post('/schedule', [SupporterUser\ScheduleController::class, 'store']);
Route::put('/schedule/{schedule_id}', [SupporterUser\ScheduleController::class, 'update'])->where('schedule_id', '[0-9]+');
Route::put('/schedule_update_all', [SupporterUser\ScheduleController::class, 'update_all']);

Route::get('/schedule/auto', [SupporterUser\ScheduleController::class, 'auto_index']);
Route::put('/schedule/auto_update_all', [SupporterUser\ScheduleController::class, 'auto_update_all']);

Route::get('/chats', [SupporterUser\ChatController::class, 'index']);
Route::get('/chats/{chat_room_id}', [SupporterUser\ChatController::class, 'search']);
Route::post('/chats/{chat_room_id}', [SupporterUser\ChatController::class, 'store']);

//upload_file
Route::group(['prefix' => 'file', 'as' => 'file.'], function () {
    Route::post('/delete', [UploadFileController::class, 'delete']);
    Route::post('/upload', [UploadFileController::class, 'store']);
    Route::post('/{file_path_id}/upload', [UploadFileController::class, 'upload'])->middleware('assigment.file.path');
});
