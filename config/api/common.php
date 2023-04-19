<?php
/*共通設定*/
return [
    //ペジネーションページ数(デフォルト値)
    'paginate_item_num' => [
        'supporter_users' => 50,
        'supporter_works_image' => 50,
        'supporter_application_documents' => 50,
        'supporter_application_details' => 50,
        'guardian_users' => 50,
        'application_forms' => 50,
        'jon_list' => 50,
    ],
    //予約内容
    'job_content' => [
        'web_interview' => 0,//WEB事前面談
        'in_person_interview' => 1,//対面事前面談
        'single' => 2,//単発予約
        'regular' => 3,//定期予約
    ],
    //仕事 依頼カテゴリー
    'job_category' =>[
        'supporter'=> 0,//ベビーシッター
        'childbirth_care' => 1,//産前産後設定
        'sick_child_care' => 2,//病児保育設定
        'housekeeping' => 3,//家事代行設定
    ],
    //仕事予約 ステータス
    'job_status' => [
        'not_set' => 0,
        'requesting' => 1,
        'quotation_offsered' => 2,
        'reservation_confirmed' => 3,
        'supporter_ready' => 4,
        'working' => 5,
        'reporting' => 6,
        'waiting_report_approval' => 7,
        'sales_confirmed' => 8,
        'expired' => 101,
        'cancel' => 102,
    ],
    //完了レポート 項目
    'report_content_item' => [
        'interview_detail' => 0,//面談内容確認
        'time_table' => 1,//タイムテーブル
        'support_detail' => 2,//サポート内容/お子様の様子
        'image' => 3,//写真添付
        'contact_etc' => 4,//連絡事項/その他
    ],
    //料金項目
    'fee_item' =>[
        'basic'=> 0,//基本料金
        'option' => 1,//オプション料金
        'transportation' => 2,//交通料金
        'discount' => 3,//割引料金
        'cancel' => 4,//キャンセル料 ※予約内容変更時に発生するキャンセル料金
        'commission' => 5,//手数料
    ],
    //手数料
    'commission_item' => [
        'supporter_use' => 0,//パークサポーター利用手数料
        'guardian_use' => 1,//保護者利用手数料
        'mitsubishi_ufj_bank' => 2,//三菱UFJ銀行 振込手数料
        'other_bank' => 3,//その他銀行 振込手数料
        'monitaring' => 4,//見守りモニタリング依頼料
    ],
    //レビュアーの種類
    'reviewer_type' => [
        'guardian' => 0,//保護者
        'supporter' => 1,//サポーター
    ],
    //曜日
    'day_of_week' => [
        'Sun' => 0, //日曜
        'Mon' => 1, //月曜
        'Tue' => 2, //火曜
        'Wed' => 3, //水曜
        'Thu' => 4, //木曜
        'Fri' => 5, //金曜
        'Sat' => 6, //土曜
    ],
    //チャットステータス
    'job_status_change' => [
        'request' => 1, //お仕事リクエストが届きました！
        'post_estimate' => 2, //見積もりを送信しました。
        'review_estimate' => 3, //見積もりの修正依頼がありました。
        'approval_estimate' => 4, //お仕事が確定しました。
        'job_yesterday' => 5, //お仕事開始24時間前です。
        'job_ready' => 6, //「準備完了」を通知しました。
        'job_start_time' => 7, //お仕事開始時間です。
        'job_start' => 8, //お仕事開始を通知しました。
        'job_end' => 9, //お仕事が終了しました。
        'post_report' => 10, //完了レポートを送信しました。
        'review_report' => 11, //完了レポートへ差し戻しがあります。
        'approval_report' => 12, //完了レポートが承認されました。
        'guardian_cancel' => 101, //ユーザーが予約をキャンセルしました
        'supporter_cancel' => 102, //あなたが予約をキャンセルしました
        'support_time_change' => 103, //ユーザーから予約時間を変更申請がありました。
    ]
];