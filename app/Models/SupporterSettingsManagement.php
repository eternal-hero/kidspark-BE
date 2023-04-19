<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupporterSettingsManagement extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = ['id'];

    protected $table = 'supporter_settings_managements';

    public function supporterSettings()
    {
        return $this->hasMany(SupporterSetting::class, 'settings_id', 'id');
    }

    public function housekeepingSupports()
    {
        return $this->hasMany(HousekeepingSupport::class, 'settings_id', 'id');
    }

    public function housekeepingSettings()
    {
        return $this->hasMany(HousekeepingSetting::class, 'settings_id', 'id');
    }

    public function supporterOptions()
    {
        return $this->hasMany(SupporterOption::class, 'settings_id', 'id');
    }

    public function supporterUsers()
    {
        return $this->belongsToMany(SupporterUser::class, 'supporter_options', 'settings_id', 'supporter_user_id');
    }

    public function supporterSupports()
    {
        return $this->hasMany(SupporterSupport::class, 'settings_id', 'id');
    }
}
