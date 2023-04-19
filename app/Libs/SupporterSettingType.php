<?php
namespace App\Libs;
use App\Models\SupporterSettingsManagement;

class SupporterSettingType
{
    private function __construct()
    {
        //
    }
    public static function getSupporterSettingType(){
        static $setting_type;
        if(!isset($setting_type)){
            $setting_type = SupporterSettingsManagement::all()->toArray();
        }
        return $setting_type;
    }
    public static function updateSupporterSettingType(){
        static $setting_type;
        $setting_type = SupporterSettingsManagement::all()->toArray();
        return $setting_type;
    }
}
