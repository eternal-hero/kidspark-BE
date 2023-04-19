<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use App\Models as Models;
use App\Libs\SupporterSettingType;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend(
            'inside_settings_id',
            function($attribute, $value, $parameters, $validator){
                $setting_type = SupporterSettingType::getSupporterSettingType();              
                return !is_bool(array_search($value, array_column($setting_type, 'id')));
            }
        );
        Validator::extend(
            'inside_application_id',
            function($attribute, $value, $parameters, $validator){      
                $query = Models\SupporterApplicationDetail::where('id', $value);
                return !is_null($query) ? true : false;
            }
        );
        Validator::extend(
            'inside_job_status',
            function($attribute, $value, $parameters, $validator){ 
                $status = config('api.common.job_status');     
                return in_array($value, $status);
            }
        );
        Validator::extend(
            'inside_job_category',
            function($attribute, $value, $parameters, $validator){ 
                $category = config('api.common.job_category');     
                return in_array($value, $category);
            }
        );
    }
}
