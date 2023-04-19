<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class SupporterUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'supporter_users';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $with = ['supporterProfileImage'];
    protected $hidden = ['password'];
    protected $fillable = [
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
    ];

    public function supporterProfileImage()
    {
        return $this->hasOne(SupporterProfileImage::class);
    }

    public function supporterSetting()
    {
        return $this->hasOne(SupporterSetting::class);
    }

    public function preInterviewSetting()
    {
        return $this->hasOne(PreInterviewSetting::class);
    }

    public function supporterProfile()
    {
        return $this->hasOne(SupporterProfile::class);
    }

    public function depositWithdrawalHistories()
    {
        return $this->hasMany(DepositWithdrawalHistory::class);
    }

    public function resultSummaries()
    {
        return $this->hasMany(ResultSummary::class);
    }

    public function supporterApplicationDocuments()
    {
        return $this->hasMany(SupporterApplicationDocument::class);
    }

    public function beneficiaryAccount()
    {
        return $this->hasOne(BeneficiaryAccount::class);
    }

    public function supporterNotice()
    {
        return $this->hasOne(SupporterNotice::class);
    }

    public function supporterApplicationDetails()
    {
        return $this->hasMany(SupporterApplicationDetail::class);
    }

    public function supportAreas()
    {
        return $this->hasMany(SupportArea::class);
    }

    public function supporterExperience()
    {
        return $this->hasOne(SupporterExperience::class);
    }

    public function supporterWorksImages()
    {
        return $this->hasMany(SupporterWorksImage::class);
    }

    public function housekeepingSupport()
    {
        return $this->hasOne(HouseKeepingSupport::class);
    }

    public function housekeepingSetting()
    {
        return $this->hasOne(HousekeepingSetting::class);
    }

    public function supporterOptions()
    {
        return $this->hasMany(SupporterOption::class);
    }

    public function supporterSettingsManagements()
    {
        return $this->belongsToMany(SupporterSettingsManagement::class, 'supporter_options', 'supporter_user_id', 'settings_id');
    }

    public function supporterSupport()
    {
        return $this->hasOne(SupporterSupport::class);
    }

    public function childbirthCareSettings()
    {
        return $this->hasOne(ChildbirthCareSetting::class);
    }

    public function childbirthCareSupports()
    {
        return $this->hasOne(ChildbirthCareSupport::class);
    }

    public function sickChildCareSettins()
    {
        return $this->hasOne(SickChildCareSetting::class);
    }

    public function sickChildCareSupports()
    {
        return $this->hasOne(SickChildCareSupport::class);
    }

    public function review()
    {
        return $this->hasMany(Review::class,'reviewer_id');
    }

    public function supporterSchedule()
    {
        return $this->hasMany(SupporterSchedule::class);
    }

    public function supporterScheduleAutoRegister()
    {
        return $this->hasMany(SupporterScheduleAutoRegister::class);
    }

    public function chatRoom()
    {
        return $this->hasMany(ChatRoom::class);
    }
}
