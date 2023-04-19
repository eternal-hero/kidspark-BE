<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentityVerification extends Model
{
    use HasFactory;
    protected $table = 'identity_verification';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'guardian_user_id',
        'status',
        'memo',
        'title',
        'request_at',
        'expiration_on',
        'additional_file_path'
    ];
    public function identity_verification_files()
    {
        return $this->hasMany(IdentityVerificationFile::class);
    }
    public function guardian_user()
    {
        return $this->belongsTo(GuardianUser::class,'guardian_user_id','id');
    }
}
