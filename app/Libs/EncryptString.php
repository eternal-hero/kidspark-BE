<?php
namespace App\Libs;
use Illuminate\Support\Facades\Crypt;

class EncryptString
{
    private function __construct()
    {
        //
    }
    public static function encriptData($data,$encryptTarget){
        foreach($data as $key => $val){
            foreach($encryptTarget as $target){
                if($key == $target) $data[$key] = Crypt::encryptString($data[$key]);
            }
        }
        return $data;
    }
    public static function decriptData($data,$encryptTarget){
        foreach($data as $key => $val){
            foreach($encryptTarget as $target){
                if($key == $target) $data[$key] = Crypt::decryptString($data[$key]);
            }
        }
        return $data;
    }
}
