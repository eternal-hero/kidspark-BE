<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class GuardianUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'guardian_users';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
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
        'status',
        'memo'
    ];

    public function children(){
        return $this->hasMany(Child::class, 'guardian_user_id');
    }

    public function guardianProfile() {
        return $this->hasOne(GuardianProfile::class, 'guardian_user_id');
    }

    public function review()
    {
        return $this->hasMany(Review::class,'reviewer_id');
    }

    public function chatRoom()
    {
        return $this->hasMany(ChatRoom::class);
    }
}
