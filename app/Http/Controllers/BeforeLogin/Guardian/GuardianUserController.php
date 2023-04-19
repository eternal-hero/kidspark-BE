<?php

namespace App\Http\Controllers\BeforeLogin\Guardian;

use App\Http\Controllers\Controller;
use App\Http\Requests\BeforeLogin\Guardian\GuardianUserRequests\StoreRequest;
use App\UseCases\BeforeLogin\Guardian\GuardianUser as GuardianUserUseCase;
use App\UseCases\BeforeLogin\Guardian\TmpGuardianUser as TmpGuardianUserUseCase;
use App\UseCases\BeforeLogin\Guardian\IdentityVerification as IdentityVerificationUseCase;
use App\UseCases\BeforeLogin\Guardian\IdentityVerificationFile as IdentityVerificationFileUseCase;
use App\Models\TmpGuardianUser;
use Illuminate\Support\Facades\DB;

class GuardianUserController extends Controller
{

    public function store(GuardianUserUseCase\CreateUseCase $create_user_UC,
    IdentityVerificationUseCase\CreateUseCase $create_IV_UC,
    IdentityVerificationFileUseCase\CreateUseCase $create_IVF_UC,
    TmpGuardianUserUseCase\DeleteUseCase $deleteUC,
    StoreRequest $request)
    {
        $auth_code = $request->header('Auth-Code-For-Pre-Guardian-User');
        if(!$auth_code){
            return response()->invalidRequestParameter("認証コードが設定されていません。");
        }

        try{
            DB::beginTransaction();
            //仮ユーザーテーブルの情報をユーザーテーブルに保存
            $tmp_guardian_user_info = TmpGuardianUser::where('auth_code',$auth_code)->where('mail_address',$request->mail_address)
            ->where('email_verified',1)->latest()->first();
            if(!$tmp_guardian_user_info){
                return response()->internalError("登録に失敗しました。");
            }
            $guardian_user_id = $create_user_UC($tmp_guardian_user_info->attributesToArray());
            //仮ユーザーテーブルから本登録したユーザーの情報を削除
            $deleteUC($tmp_guardian_user_info->attributesToArray());

            //本人確認書類情報を保存
            $upload_file_controller = app()->make('App\Http\Controllers\UploadFileController');
            $request['upload_path'] = "public/identity_verification";
            $additional_file_path = "";
            if($request->file){
                $file_name = $upload_file_controller->upload($request);
                $result = $file_name->getData('data');
                $additional_file_path = $result['data'];
            }
            $identity_verification_info = [
                'guardian_user_id' => $guardian_user_id,
                'status' => 0,
                'memo' => $request->memo,
                'title' => $request->title,
                'request_at' => date("Y/m/d H:i:s"),
                'expiration_on' => date("Y/m/d",strtotime(date("Y/m/d") . "+3 month")),
                'additional_file_path' => $additional_file_path

            ];
            $identity_verification = $create_IV_UC($identity_verification_info);

            //本人確認書類を保存
            $files = $request->main_files;
            $file_names = $upload_file_controller->uploadArrayFiles($files,"identity_verification_files");
            foreach($file_names as $name){
                $identity_verification_file_info = [
                    'identity_verification_id' => $identity_verification->id,
                    'file_path' => $name
                ];
                $create_IVF_UC($identity_verification_file_info);
            }

            DB::commit();
            return response()->ok();

        }catch (\Exception $e) {
            DB::rollBack();
            return response()->internalError($e);
        }
    }
}
