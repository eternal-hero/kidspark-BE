<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmpGuardianUser extends Model
{
    use HasFactory;
    protected $table = 'tmp_guardian_users';
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
        'password',
        'auth_code',
        'email_verified'
    ];

}
