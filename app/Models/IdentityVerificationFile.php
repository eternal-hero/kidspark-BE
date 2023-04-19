<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentityVerificationFile extends Model
{
    use HasFactory;
    protected $table = 'identity_verification_files';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'identity_verification_id',
        'file_path'
    ];
    public function identity_verification()
    {
        return $this->belongsTo(IdentityVerification::class);
    }
}
