<?php
namespace App\UseCases\BeforeLogin\Guardian\GuardianUser;

use App\Models\GuardianUser;


class CreateUseCase
{
    public function __invoke(array $data)
    {
        unset($data['id']);
        unset($data['auth_code']);
        unset($data['email_verified']);
        unset($data['created_at']);
        unset($data['updated_at']);
        $data['family_structure'] = "未設定";
        $data['is_pets'] = 0;
        $data['housing_type'] = "未設定";
        $data['is_camera'] = 0;
        $data['emergency_contact_name'] = "未設定";
        $data['emergency_contact_phone_number'] = "未設定";
        $data['emergency_contact_relation'] = "未設定";
        $data['status'] = 0;
        $data['memo'] = "未設定";
        $guardian_user = GuardianUser::create($data);
        return $guardian_user->id;
    }
}
