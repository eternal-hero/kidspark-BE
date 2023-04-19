<?php
/*保護者側 設定ファイル*/
return [
    //guardian_userテーブルの画面毎の要素
    'user_param' => [
        'list' => [
            'first_name',
            'last_name',
            'first_kana',
            'last_kana',
            'emergency_contact_phone_number',
            'prefecture',
            'guardianProfile',
            'near_station',
            'children',
            'is_camera',
            'status'
        ],
        'profile' => [
            'first_name',
            'last_name',
            'first_kana',
            'last_kana',
            'nickname',
            'gender',
            'relation',
            'birthday',
            'post_code',
            'prefecture',
            'municipality',
            'street_name',
            'building',
            'contact_phone_number',
            'mail_address',
            'workspace',
            'family_structure',
            'is_pets',
            'housing_type',
            'is_camera',
            'emergency_contact_name',
            'emergency_contact_phone_number',
            'emergency_contact_relation',
            'status'
        ],
        'password' => [
            'password'
        ],
    ],
];