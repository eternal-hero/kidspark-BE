<?php

namespace App\UseCases\Admin\Common\Job\Job;

use App\Models\Job;

class DetailUseCase
{
    public function __invoke($job_id)
    {
        $job = Job::find($job_id);
        $job_status = $job->only(['id','guardian_user_id','supporter_user_id','status']);
        $status_item = config('api.common.job_status');

        $data = [];
        $data['base_info'] = $job_status;
        //ユーザ情報
        $guardian_user = $job->guardianUser;
        if($guardian_user){
                $guardian_user_info = $guardian_user->only([
                'id',//保護者ID
                'first_name',//名前
                'last_name',//姓
                'first_kana',//名前 ふりがな
                'last_kana',//姓 ふりがな
                'contact_phone_number',//連絡先電話番号
                'emergency_contact_phone_number',//緊急連絡先の電話番号
                'is_pets',//ペットの有無
                'is_camera'//カメラ設置
            ]);
        }
        $data['guardian_user'] = $guardian_user_info;

        //お子様情報
        $reserve_children = $job->reserveChild;
        $children = [];
        if($reserve_children){
            foreach($reserve_children as $child){
                $children[] = $child->only([
                    'id',//子供ID
                    'first_name',//名前
                    'last_name',//姓
                    'first_kana',//名前 ふりがな
                    'last_kana',//姓 ふりがな
                    'gender',//性別
                    'birthday',//生年月日
                    'allergy',//アレルギー
                    'chronic_disease'//持病
                ]);
            }
        }
        $data['children'] = $children;

        //サポート場所
        if($guardian_user){
            $guardian_address = $guardian_user->only([
                'prefecture',//都道府県
                'municipality',//市区町村
                'street_name',//丁目・番地・号
                'building'//建物名
            ]);
            $guardian_profile = $guardian_user->guardianProfile;
            if($guardian_profile){
                $guardian_near_station = $guardian_profile->only([
                    'near_line',//最寄り路線
                    'near_station',//最寄り駅
                    'means',//最寄り駅までの移動手段
                    'travel_time',//最寄り駅までの所要時間
                    'is_publish'//最寄り駅の公開
                ]);
            }
        }
        $data['support_area'] = array_merge($guardian_address,$guardian_near_station);

        //保護者写真関係
        $profile_images = $guardian_profile->guardianProfileImage;
        $guardian_profile_images = [];
        if($profile_images){
            foreach($profile_images as $fee_item){
                $guardian_profile_images[] = $fee_item->only([
                    'image_path',//画像パス
                    'which_image',//写真の種類
                ]);
            }
        }
        $data['guardian_profile_images'] = $guardian_profile_images;

        //パークサポーター情報
        $supporter_user = $job->supporterUser;
        if($supporter_user){
            $supporter_user_info = $supporter_user->only([
                'id',//サポーターID
                'first_name',//名前
                'last_name',//姓
                'first_kana',//名前 ふりがな
                'last_kana',//姓 ふりがな
                'phone_number',//電話番号
                'prefecture',//都道府県
                'municipality',//市区町村
                'street_name',//丁目・番地・号
                'building'//建物
            ]);
            $supporter_profile = $supporter_user->supporterProfile->only([
                'near_line',//最寄り路線
                'near_station',//最寄り駅
                'means',//最寄り駅からの交通手段
                'travel_times',//最寄り駅からの所要時間
                'is_publish'//最寄り駅の公開
            ]);
        }
        $data['supporter'] = array_merge($supporter_user_info,$supporter_profile);

        //サポート履歴
        $job_support_record = $job->jobSupportRecord;
        if($job_support_record){
            $job_support_record_info = $job_support_record->only([
                'support_preparation_at',//サポート準備完了時間
                'support_start_at',//サポート開始時間
                'support_end_at',//サポート終了時間
                'report_send_at',//レポート提出時間
                'report_approval_at'//レポート承認時間
            ]);
        }
        $data['job_support_record'] = $job_support_record_info;

        //予約概要
        $job_reversion_summary = $job->jobReservationSummary;
        if($job_reversion_summary){
            $job_reversion_summary_info = $job_reversion_summary->only([
                'job_id',//お仕事ID
                'start_at',//開始時間
                'end_at',//終了時間
                'job_content',//予約内容
                'request_category',//依頼カテゴリー
                'monitaring_id'//見守りモニタリング依頼
            ]);
            $job_monitaring = $job_reversion_summary->jobMonitaring->only([
                'is_monitarings',//見守りモニタリング依頼
                'user_name',//Ezvizユーザ名
                'password',//Ezvizパスワード
                'note'//備考
            ]);
        }
        $data['job_reversion_summary'] = $job_reversion_summary_info;

        //事前見積もり
        $pre_quotation = $job->preQuotation;
        $pre_quotation_info = $pre_quotation->only([
            'support_start_at',//開始時間
            'support_end_at',//終了時間
            'total'//合計金額
        ]);
        $fee_items = $pre_quotation->quotationFeeItem;
        $quotation_fee_items = [];
        if($fee_items){
            foreach($fee_items as $fee_item){
                $quotation_fee_items[] = $fee_item->only([
                    'item_type',//項目の種類
                    'fee',//金額
                    'detail' //内訳、詳細
                ]);
            }
        }
        $data['pre_quotation'] = ['info' => $pre_quotation_info,'detail'=>$quotation_fee_items];

        //お仕事完了後
        if(in_array($job->status,[$status_item['sales_confirmed'],$status_item['waiting_report_approval'],$status_item['reporting'],$status_item['waiting_report_approval'],$status_item['sales_confirmed']])){
            //最終受取金額
            $completion_report = $job->completionReport;
            $completion_report_info = $completion_report->only([
                'start_at',//開始時間
                'end_at',//終了時間
                'total'//合計金額
            ]);
            $fee_items = $completion_report->reportFeeItem;
            $report_item_fees = [];
            if($fee_items){
                foreach($fee_items as $fee_item){
                    $report_item_fees[] = $fee_item->only([
                        'item_type',//項目の種類
                        'fee',//金額
                        'detail' //内訳、詳細
                    ]);
                }
            }
            $data['completion_report'] = ['info' => $completion_report_info,'detail'=>$report_item_fees];
            //キッズパークの収益
            $kidspark_revenue = $job->kidsparkRevenue->only([
                'supporter_commision_fee',//サポーター手数料(金額)
                'supporter_commision_percentage',//サポーター手数料(割合)
                'guardian_commision_fee',//保護者手数料(金額)
                'guardian_commision_percentage',//保護者手数料(割合)
                'total',//合計金額
            ]);
            $data['kidspark_revenue'] = $kidspark_revenue;

        }

        //キャンセルまたは取消
        $job_cancel = $job->jobCancel;
        $job_cancel_info = $job_cancel->only([
            'status',//キャンセルのステータス
            'reason',//キャンセル理由
            'date',//キャンセルの日付
            'reason_detail',//キャンセル理由詳細
            'fee',//キャンセル金額
            'confirmation_bitflag'//確認事項ビットフラグ
        ]);
        $cancel_user = $job_cancel->applicantUser;
        $job_cancel_info['cancel_user'] = $cancel_user->only([
            'id',//サポーターID
            'first_name',//名前
            'last_name',//姓
        ]);
        $data['job_cancel'] = $job_cancel_info;
        return $data;
    }
}
