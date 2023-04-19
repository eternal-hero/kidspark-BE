<?php

namespace App\UseCases\Guardians\Job;

use App\Models\Job;

class SearchUseCase
{
    public function __invoke($job_id)
    {
        $job_status = Job::where('id', $job_id)->first();
        switch ($job_status->status) {
            case 1: //リクエスト中
                $job = Job::with([
                    'supporterUser:id,first_name,last_name,first_kana,last_kana',
                    'guardianUser:id,first_name,last_name,first_kana,last_kana,is_pets,housing_type,is_camera,prefecture,municipality',
                    'guardianUser.guardianProfile:id,near_line,near_station,means,travel_time,rule',
                    'reserveChild.children:id,gender,birthday,allergy,chronic_disease,other',
                    'jobRequest',
                    'jobRequest.estimatedAmount',
                ])->where('id', $job_id)->first();
                return $job;
                break;
            case 2: //見積提示
                $job = Job::with([
                    'supporterUser:id,first_name,last_name,first_kana,last_kana',
                    'guardianUser:id,first_name,last_name,first_kana,last_kana,is_pets,housing_type,is_camera,prefecture,municipality',
                    'guardianUser.guardianProfile:id,near_line,near_station,means,travel_time,rule',
                    'reserveChild.children:id,gender,birthday,allergy,chronic_disease,other',
                    'jobRequest',
                    'preQuotation',
                    'preQuotation.quotationFeeItem',
                ])->where('id', $job_id)->first();
                return $job;
                break;
                case [3,4,5,6]: //予約確定
                    $job = Job::with([
                    'supporterUser',
                    'guardianUser',
                    'guardianUser.guardianProfile',
                    'guardianUser.guardianProfile.guardianProfileImage',
                    'reserveChild.children',
                    'jobRequest',
                    'preQuotation',
                    'preQuotation.quotationFeeItem',
                    ])->where('id', $job_id)->first();
                    return $job;
                    break;
            case 7: //見積提示
                $job = Job::with([
                    'supporterUser:id,first_name,last_name,first_kana,last_kana',
                    'guardianUser:id,first_name,last_name,first_kana,last_kana,is_pets,housing_type,is_camera,prefecture,municipality',
                    'guardianUser.guardianProfile:id,near_line,near_station,means,travel_time,rule',
                    'reserveChild.children:id,gender,birthday,allergy,chronic_disease,other',
                    'jobRequest',
                    'preQuotation',
                    'preQuotation.quotationFeeItem',
                    'completionReport',
                    'completionReport.reportContent',
                    'completionReport.reportFeeItem',
                ])->where('id', $job_id)->first();
                return $job;
                break;
            case [102,103]: //キャンセル
                $job = Job::with([
                    'supporterUser:id,first_name,last_name,first_kana,last_kana',
                    'guardianUser:id,first_name,last_name,first_kana,last_kana,is_pets,housing_type,is_camera,prefecture,municipality',
                    'guardianUser.guardianProfile:id,near_line,near_station,means,travel_time,rule',
                    'reserveChild.children:id,gender,birthday,allergy,chronic_disease,other',
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
