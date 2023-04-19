<?php
/*サポーター側 設定ファイル*/
return [
    //サポーター設定の種類
    'supporter_setting_type' => [
        'supporter'=> 'パークサポーター設定',
        'childbirth_care' => '産前産後設定',
        //'tutor' => '家庭教師設定',
        'sick_child_care' => '病児保育設定',
        'housekeeping' => '家事代行設定'
    ],
    //supporter_userテーブルの画面毎のカラム
    'user_param' => [
        'profile' => [
            'first_name',
            'last_name',
            'first_kana',
            'last_kana',
            'gender',
            'birthday',
            'post_code',
            'prefecture',
            'municipality',
            'street_name',
            'building',
            'phone_number',
            'mail_address',
            'supporter_id',
        ],
        'password' => [
            'password',
        ],
    ],
];