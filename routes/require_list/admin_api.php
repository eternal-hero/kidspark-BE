<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Guardian as Guardian;
use App\Http\Controllers\Common as Common;
use App\Http\Controllers\Admin\Common as AdminCommon;
use App\Http\Controllers\Admin\Supporter as Supporter;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\Admin as Admin;


Route::group(['prefix' => 'auth'], function () {
    /*logout*/
    Route::post('logout', [Admin\AuthController::class, 'logout']);
});

/*common*/
Route::group(['prefix' => 'common', 'as' => 'common.'], function () {
    
    // Inoculation status
    Route::get('inoculation/{id?}', [Common\InoculationStatusController::class, 'index']);
    Route::put('inoculation/{id}', [Common\InoculationStatusController::class, 'update']);
    Route::post('inoculation/', [Common\InoculationStatusController::class, 'store']);
    Route::delete('inoculation/{id}', [Common\InoculationStatusController::class, 'destroy']);
});
Route::group(['prefix' => 'admin_common', 'as' => 'Admincommon.'], function () {

    // Job
    Route::get('job', [AdminCommon\Job\JobController::class, 'list']);
    Route::get('job/{job_id}', [AdminCommon\Job\JobController::class, 'detail']);
    Route::get('job/{job_id}/reports', [AdminCommon\Job\JobController::class, 'report']);
});
/*supporter*/
Route::group(['prefix' => 'supporter', 'as' => 'supporter.'], function () {
    // Supporter_user
    Route::get('/', [Supporter\UserController::class, 'index']);
    Route::get('/{supporter_user_id}', [Supporter\UserController::class, 'show']);
    Route::post('/', [Supporter\UserController::class, 'store']);
    Route::put('/{supporter_user_id}', [Supporter\UserController::class, 'update']);
    Route::delete('/{supporter_user_id}', [Supporter\UserController::class, 'destroy']);
    //supporter_user_password
    Route::put('/{supporter_user_id}/password', [Supporter\UserController::class, 'update_password']);
    //ProfileImage
    Route::get('/{supporter_user_id}/images', [Supporter\ProfileImageController::class, 'index']);
    Route::put('/{supporter_user_id}/images', [Supporter\ProfileImageController::class, 'update']);
    Route::post('/{supporter_user_id}/images', [Supporter\ProfileImageController::class, 'store']);
    Route::delete('/{supporter_user_id}/images', [Supporter\ProfileImageController::class, 'destroy']);
    // Profile
    Route::get('/{supporter_user_id}/profiles', [Supporter\ProfileController::class, 'index']);
    Route::put('/{supporter_user_id}/profiles', [Supporter\ProfileController::class, 'update']);
    Route::post('/{supporter_user_id}/profiles', [Supporter\ProfileController::class, 'store']);
    Route::delete('/{supporter_user_id}/profiles', [Supporter\ProfileController::class, 'destroy']);
    // Support area
    Route::get('/{supporter_user_id}/support_area/{support_area_id?}', [Supporter\SupportAreaController::class, 'index'])->name('support_area.index');
    Route::post('/{supporter_user_id}/support_area', [Supporter\SupportAreaController::class, 'store'])->name('support_area.store');
    Route::put('/{supporter_user_id}/support_area/{support_area_id}', [Supporter\SupportAreaController::class, 'update'])->name('support_area.update');
    Route::delete('/{supporter_user_id}/support_area/{support_area_id?}', [Supporter\SupportAreaController::class, 'delete'])->name('support_area.delete');
    Route::post('/{supporter_user_id}/support_area_all', [Supporter\SupportAreaController::class, 'update_all']);
    //PreInterviewSetting
    Route::get('{supporter_user_id}/pre_interview', [Supporter\PreInterviewSettingController::class, 'index']);
    Route::post('{supporter_user_id}/pre_interview', [Supporter\PreInterviewSettingController::class, 'store']);
    Route::put('{supporter_user_id}/pre_interview', [Supporter\PreInterviewSettingController::class, 'update']);
    Route::delete('{supporter_user_id}/pre_interview', [Supporter\PreInterviewSettingController::class, 'destroy']);
    // Setting managements
    Route::get('/settings/managements/{id?}', [Supporter\SettingsManagementController::class, 'index'])->name('settings.management');
    // Supporter_settings
    Route::get('/{supporter_user_id}/settings', [Supporter\SettingController::class, 'index']);
    Route::put('/{supporter_user_id}/settings', [Supporter\SettingController::class, 'update']);
    Route::post('/{supporter_user_id}/settings', [Supporter\SettingController::class, 'store']);
    Route::delete('/{supporter_user_id}/settings', [Supporter\SettingController::class, 'delete']);
    // Supporter_options
    Route::get('{supporter_user_id}/settings/options', [Supporter\OptionController::class, 'index']);
    Route::post('{supporter_user_id}/settings/options', [Supporter\OptionController::class, 'store']);
    Route::put('{supporter_user_id}/settings/options/{option_id}', [Supporter\OptionController::class, 'update']);
    Route::delete('{supporter_user_id}/settings/options/{option_id}', [Supporter\OptionController::class, 'destroy']);
    Route::put('{supporter_user_id}/settings/options_all', [Supporter\OptionController::class, 'update_all']);
    // Supporter support
    Route::get('/{supporter_user_id}/settings/supports', [Supporter\SupportController::class, 'index'])->name('support.index');
    Route::post('/{supporter_user_id}/settings/supports', [Supporter\SupportController::class, 'store'])->name('support.store');
    Route::put('/{supporter_user_id}/settings/supports', [Supporter\SupportController::class, 'update'])->name('support.update');
    Route::delete('/{supporter_user_id}/settings/supports', [Supporter\SupportController::class, 'delete'])->name('support.delete');
    //supporter_experience
    Route::get('/{supporter_user_id}/settings/experience', [Supporter\ExperienceController::class, 'show']);
    Route::post('/{supporter_user_id}/settings/experience', [Supporter\ExperienceController::class, 'store']);
    Route::put('/{supporter_user_id}/settings/experience', [Supporter\ExperienceController::class, 'update']);
    Route::delete('/{supporter_user_id}/settings/experience', [Supporter\ExperienceController::class, 'destroy']);
    // childbirth_care_settings
    Route::get('/{supporter_user_id}/childbirth_care/settings', [Supporter\ChildbirthCare\SettingController::class, 'show']);
    Route::put('/{supporter_user_id}/childbirth_care/settings', [Supporter\ChildbirthCare\SettingController::class, 'update']);
    Route::post('/{supporter_user_id}/childbirth_care/settings', [Supporter\ChildbirthCare\SettingController::class, 'store']);
    Route::delete('/{supporter_user_id}/childbirth_care/settings', [Supporter\ChildbirthCare\SettingController::class, 'delete']);
    // childbirth_care_support
    Route::get('/{supporter_user_id}/childbirth_care/supports', [Supporter\ChildbirthCare\SupportController::class, 'show']);
    Route::post('/{supporter_user_id}/childbirth_care/supports', [Supporter\ChildbirthCare\SupportController::class, 'store']);
    Route::put('/{supporter_user_id}/childbirth_care/supports', [Supporter\ChildbirthCare\SupportController::class, 'update']);
    Route::delete('/{supporter_user_id}/childbirth_care/supports', [Supporter\ChildbirthCare\SupportController::class, 'delete']);
    // sick_child_care_settings
    Route::get('/{supporter_user_id}/sick_child_care/settings', [Supporter\SickChildCare\SettingController::class, 'show']);
    Route::put('/{supporter_user_id}/sick_child_care/settings', [Supporter\SickChildCare\SettingController::class, 'update']);
    Route::post('/{supporter_user_id}/sick_child_care/settings', [Supporter\SickChildCare\SettingController::class, 'store']);
    Route::delete('/{supporter_user_id}/sick_child_care/settings', [Supporter\SickChildCare\SettingController::class, 'delete']);
    // sick_child_care_support
    Route::get('/{supporter_user_id}/sick_child_care/supports', [Supporter\SickChildCare\SupportController::class, 'show']);
    Route::post('/{supporter_user_id}/sick_child_care/supports', [Supporter\SickChildCare\SupportController::class, 'store']);
    Route::put('/{supporter_user_id}/sick_child_care/supports', [Supporter\SickChildCare\SupportController::class, 'update']);
    Route::delete('/{supporter_user_id}/sick_child_care/supports', [Supporter\SickChildCare\SupportController::class, 'delete']);
    //housekeeping_settings
    Route::get('/{supporter_user_id}/housekeeping', [Supporter\Housekeeping\SettingController::class, 'show']);
    Route::post('/{supporter_user_id}/housekeeping', [Supporter\Housekeeping\SettingController::class, 'store']);
    Route::put('/{supporter_user_id}/housekeeping', [Supporter\Housekeeping\SettingController::class, 'update']);
    Route::delete('/{supporter_user_id}/housekeeping', [Supporter\Housekeeping\SettingController::class, 'destroy']);
    //housekeeping_supports
    Route::get('/{supporter_user_id}/housekeeping/supports', [Supporter\Housekeeping\SupportController::class, 'show']);
    Route::post('/{supporter_user_id}/housekeeping/supports', [Supporter\Housekeeping\SupportController::class, 'store']);
    Route::put('/{supporter_user_id}/housekeeping/supports', [Supporter\Housekeeping\SupportController::class, 'update']);
    Route::delete('/{supporter_user_id}/housekeeping/supports', [Supporter\Housekeeping\SupportController::class, 'destroy']);
    //works_image
    Route::get('/{supporter_user_id}/works_images', [Supporter\WorkImageController::class, 'index']);
    Route::post('/{supporter_user_id}/works_images', [Supporter\WorkImageController::class, 'store']);
    Route::get('/{supporter_user_id}/works_images/{works_image_id?}', [Supporter\WorkImageController::class, 'show']);
    Route::put('/{supporter_user_id}/works_images/{works_image_id}', [Supporter\WorkImageController::class, 'update']);
    Route::delete('/{supporter_user_id}/works_images/{works_image_id?}', [Supporter\WorkImageController::class, 'destroy']);
    //result summary
    Route::get('/{supporter_user_id}/result/summaries/{recode_date}', [Supporter\Result\SummaryController::class, 'show']);
    //result review
    Route::get('result/{job_id}/reviews', [Supporter\Result\ReviewController::class, 'index']);
    Route::post('result/{job_id}/reviews', [Supporter\Result\ReviewController::class, 'store']);
    Route::put('result/{job_id}/reviews', [Supporter\Result\ReviewController::class, 'update']);
    Route::delete('result/{job_id}/reviews', [Supporter\Result\ReviewController::class, 'destroy']);
    //result sales
    Route::get('result/{job_id}/sales', [Supporter\Result\SaleController::class, 'index']);
    Route::post('result/{job_id}/sales', [Supporter\Result\SaleController::class, 'store']);
    Route::put('result/{job_id}/sales', [Supporter\Result\SaleController::class, 'update']);
    Route::delete('result/{job_id}/sales', [Supporter\Result\SaleController::class, 'destroy']);
    // deposit_withdrawal_histories
    Route::get('/{supporter_user_id}/deposit_withdrawal/{deposit_withdrawal_id?}', [Supporter\DepositWithdrawalHistoryController::class, 'show']);
    Route::post('/{supporter_user_id}/deposit_withdrawal', [Supporter\DepositWithdrawalHistoryController::class, 'store']);
    Route::put('/{supporter_user_id}/deposit_withdrawal/{deposit_withdrawal_id}', [Supporter\DepositWithdrawalHistoryController::class, 'update']);
    Route::delete('/{supporter_user_id}/deposit_withdrawal/{deposit_withdrawal_id?}', [Supporter\DepositWithdrawalHistoryController::class, 'destroy']);
    // Job reservation
    Route::get('/{supporter_user_id}/job_reservations', [Supporter\JobReservationController::class, 'index']);
    Route::put('/{supporter_user_id}/job_reservations', [Supporter\JobReservationController::class, 'update']);
    Route::post('/{supporter_user_id}/job_reservations', [Supporter\JobReservationController::class, 'store']);
    Route::delete('/{supporter_user_id}/job_reservations', [Supporter\JobReservationController::class, 'destroy']);
    // Beneficiary accounts
    Route::get('/{supporter_user_id}/accounts', [Supporter\BeneficiaryAccountController::class, 'index']);
    Route::put('/{supporter_user_id}/accounts', [Supporter\BeneficiaryAccountController::class, 'update']);
    Route::post('/{supporter_user_id}/accounts', [Supporter\BeneficiaryAccountController::class, 'store']);
    Route::delete('/{supporter_user_id}/accounts', [Supporter\BeneficiaryAccountController::class, 'destroy']);
    // supporter notice
    Route::get('/{supporter_user_id}/notices', [Supporter\NoticeController::class, 'show']);
    Route::post('/{supporter_user_id}/notices', [Supporter\NoticeController::class, 'update']);
    Route::put('/{supporter_user_id}/notices', [Supporter\NoticeController::class, 'store']);
    Route::delete('/{supporter_user_id}/notices', [Supporter\NoticeController::class, 'destroy']);
    // Application document
    Route::get('/application/documents/list', [Supporter\Application\DocumentController::class, 'list']);
    Route::get('/{supporter_user_id}/application/documents/', [Supporter\Application\DocumentController::class, 'index']);
    Route::get('/{supporter_user_id}/application/documents/{application_document_id?}', [Supporter\Application\DocumentController::class, 'show']);
    Route::put('/{supporter_user_id}/application/documents/{application_document_id}', [Supporter\Application\DocumentController::class, 'update']);
    Route::post('/{supporter_user_id}/application/documents/', [Supporter\Application\DocumentController::class, 'store']);
    Route::delete('/{supporter_user_id}/application/documents/{application_document_id?}', [Supporter\Application\DocumentController::class, 'destroy']);
    Route::post('/{supporter_user_id}/application/documents/upload', [Supporter\Application\DocumentController::class, 'uploadFile']);
    // Application details
    Route::get('/{supporter_user_id}/application/details/{application_detail_id?}', [Supporter\Application\Detail\DetailController::class, 'show']);
    Route::post('/{supporter_user_id}/application/details', [Supporter\Application\Detail\DetailController::class, 'store']);
    Route::put('/{supporter_user_id}/application/details/{application_detail_id}', [Supporter\Application\Detail\DetailController::class, 'update']);
    Route::delete('/{supporter_user_id}/application/details/{application_detail_id}', [Supporter\Application\Detail\DetailController::class, 'destroy']);
    // Application detail hitory
    Route::get('/application/detail/{application_detail_id}/histories', [Supporter\Application\Detail\HistoryController::class, 'index']);
    Route::post('/application/detail/{application_detail_id}/histories', [Supporter\Application\Detail\HistoryController::class, 'store']);
    Route::delete('/application/detail/{application_detail_id}/histories', [Supporter\Application\Detail\HistoryController::class, 'destroy']);
});
/*guardian*/
Route::group(['prefix' => 'guardian'], function () {
    //guardian_user
    Route::get('/', [Guardian\UserController::class, 'index']);
    Route::post('/', [Guardian\UserController::class, 'store']);
    Route::get('/{id}', [Guardian\UserController::class, 'show']);
    Route::put('/{id}', [Guardian\UserController::class, 'update']);
    Route::delete('/{id}', [Guardian\UserController::class, 'destroy']);
    //guardian_user_password
    Route::put('/{id}/password', [Guardian\UserController::class, 'update_password']);
    //children
    Route::get('/{guardian_id}/children', [Guardian\ChildController::class, 'index']);
    Route::post('/{guardian_id}/children', [Guardian\ChildController::class, 'store']);
    Route::get('/{guardian_id}/children/{id}', [Guardian\ChildController::class, 'show']);
    Route::put('/{guardian_id}/children/{id}', [Guardian\ChildController::class, 'update']);
    Route::delete('/{guardian_id}/children/{id}', [Guardian\ChildController::class, 'destroy']);
    Route::put('/{guardian_id}/children_update_all', [Guardian\ChildController::class, 'update_all']);

    //guardian_profiles
    Route::get('/{guardian_id}/profiles', [Guardian\Profile\ProfileController::class, 'index']);
    Route::post('/{guardian_id}/profiles', [Guardian\Profile\ProfileController::class, 'store']);
    Route::put('/{guardian_id}/profiles', [Guardian\Profile\ProfileController::class, 'update']);
    Route::delete('/{guardian_id}/profiles', [Guardian\Profile\ProfileController::class, 'destroy']);
    //guardian_profile_images
    Route::get('/{guardian_id}/profiles/images', [Guardian\Profile\ImageController::class, 'index']);
    Route::post('/{guardian_id}/profiles/images', [Guardian\Profile\ImageController::class, 'store']);
    Route::get('/{guardian_id}/profiles/images/{id}', [Guardian\Profile\ImageController::class, 'show']);
    Route::put('/{guardian_id}/profiles/images/{id}', [Guardian\Profile\ImageController::class, 'update']);
    Route::delete('/{guardian_id}/profiles/images/{id}', [Guardian\Profile\ImageController::class, 'destroy']);
    //identity_verification
    Route::get('/identity_verifications/list', [Guardian\IdentityVerificationController::class,'list']);
    Route::get('/{guardian_id}/identity_verifications', [Guardian\IdentityVerificationController::class, 'index']);
    Route::post('/{guardian_id}/identity_verifications', [Guardian\IdentityVerificationController::class, 'store']);
    Route::get('/{guardian_id}/identity_verifications/{id}', [Guardian\Profile\ImageController::class, 'show']);
    Route::put('/{guardian_id}/identity_verifications/{id}', [Guardian\IdentityVerificationController::class, 'update']);
    Route::delete('/{guardian_id}/identity_verifications/{id}', [Guardian\IdentityVerificationController::class, 'destroy']);
    //guardian_notice
    Route::get('/{guardian_id}/notices', [Guardian\NoticeController::class, 'index']);
    Route::post('/{guardian_id}/notices', [Guardian\NoticeController::class, 'store']);
    Route::put('/{guardian_id}/notices/{id}', [Guardian\NoticeController::class, 'update']);
    Route::delete('/{guardian_id}/notices/{id}', [Guardian\NoticeController::class, 'destroy']);
    //application_forms
    Route::get('/{guardian_id}/application_forms', [Guardian\ApplicationFormController::class, 'index']);
    Route::post('/{guardian_id}/application_forms', [Guardian\ApplicationFormController::class, 'store']);
    Route::get('/{guardian_id}/application_forms/{id}', [Guardian\ApplicationFormController::class, 'show']);
    Route::put('/{guardian_id}/application_forms/{id}', [Guardian\ApplicationFormController::class, 'update']);
    Route::delete('/{guardian_id}/application_forms/{id}', [Guardian\ApplicationFormController::class, 'destroy']);
    //points
    Route::get('/{guardian_id}/points', [Guardian\PointController::class, 'index']);
    Route::post('/{guardian_id}/points', [Guardian\PointController::class, 'store']);
    Route::get('/{guardian_id}/points/{id}', [Guardian\PointController::class, 'show']);
    Route::put('/{guardian_id}/points/{id}', [Guardian\PointController::class, 'update']);
    Route::delete('/{guardian_id}/points/{id}', [Guardian\PointController::class, 'destroy']);
    //publish_applications
    Route::get('/{guardian_id}/publish_applications', [Guardian\PublishApplicationController::class, 'index']);
    Route::post('/{guardian_id}/publish_applications', [Guardian\PublishApplicationController::class, 'store']);
    Route::get('/{guardian_id}/publish_applications/{id}', [Guardian\PublishApplicationController::class, 'show']);
    Route::put('/{guardian_id}/publish_applications/{id}', [Guardian\PublishApplicationController::class, 'update']);
    Route::delete('/{guardian_id}/publish_applications/{id}', [Guardian\PublishApplicationController::class, 'destroy']);
});
//upload_file
Route::group(['prefix' => 'file', 'as' => 'file.'], function () {
    Route::post('/delete', [UploadFileController::class, 'delete']);
    Route::post('/{file_path_id}/upload', [UploadFileController::class, 'upload'])->middleware('assigment.file.path');
    Route::post('/upload-file', [UploadFileController::class, 'upload']);
});

?>
