<?php

namespace App\UseCases\Supporter\Job\Detail;

use App\Models\Job;

class SearchUseCase
{
    public function __invoke($job_id)
    {
        $job_status = Job::where('id', $job_id)->first();
        switch (true) {
            case $job_status->status === 1: //リクエスト中
                $job = Job::with([
                    'supporterUser:id,first_name,last_name,first_kana,last_kana',
                    'guardianUser:id,first_name,last_name,first_kana,last_kana,is_pets,housing_type,is_camera,prefecture,municipality',
                    'guardianUser.guardianProfile:id,near_line,near_station,means,travel_time,rule',
                    'reserveChild:id,gender,birthday,allergy,chronic_disease,other',
                    'jobRequest',
                    'jobRequest.estimatedAmount',
                ])->where('id', $job_id)->first();
                return $job;
                break;
            case $job_status->status === 2: //見積提示
                $job = Job::with([
                    'supporterUser:id,first_name,last_name,first_kana,last_kana',
                    'guardianUser:id,first_name,last_name,first_kana,last_kana,is_pets,housing_type,is_camera,prefecture,municipality',
                    'guardianUser.guardianProfile:id,near_line,near_station,means,travel_time,rule',
                    'reserveChild:id,gender,birthday,allergy,chronic_disease,other',
                    'jobRequest',
                    'preQuotation',
                    'preQuotation.quotationFeeItem',
                ])->where('id', $job_id)->first();
                return $job;
                break;
            case $job_status->status >= 3 && $job_status->status <= 6: //予約確定
                $job = Job::with([
                    'supporterUser',
                    'guardianUser',
                    'guardianUser.guardianProfile',
                    'guardianUser.guardianProfile.guardianProfileImage',
                    'reserveChild',
                    'jobRequest',
                    'preQuotation',
                    'preQuotation.quotationFeeItem',
                ])->where('id', $job_id)->first();
                return $job;
                break;
            case $job_status->status === 7: //見積提示
                $job = Job::with([
                    'supporterUser:id,first_name,last_name,first_kana,last_kana',
                    'guardianUser:id,first_name,last_name,first_kana,last_kana,is_pets,housing_type,is_camera,prefecture,municipality',
                    'guardianUser.guardianProfile:id,near_line,near_station,means,travel_time,rule',
                    'reserveChild:id,gender,birthday,allergy,chronic_disease,other',
                    'jobRequest',
                    'preQuotation',
                    'preQuotation.quotationFeeItem',
                    'completionReport',
                    'completionReport.reportContent',
                    'completionReport.reportFeeItem',
                ])->where('id', $job_id)->first();
                return $job;
                break;
            case $job_status->status === 102 || $job_status->status === 103: //キャンセル
                $job = Job::with([
                    'supporterUser:id,first_name,last_name,first_kana,last_kana',
                    'guardianUser:id,first_name,last_name,first_kana,last_kana,is_pets,housing_type,is_camera,prefecture,municipality',
                    'guardianUser.guardianProfile:id,near_line,near_station,means,travel_time,rule',
                    'reserveChild:id,gender,birthday,allergy,chronic_disease,other',
                    'jobRequest',
                    'preQuotation',
                    'preQuotation.quotationFeeItem',
                    'jobCancel'
                ])->where('id', $job_id)->first();
                return $job;
                break;
            default:
                return;
                break;
        }
    }
}
