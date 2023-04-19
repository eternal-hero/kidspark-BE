<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardianProfileImage extends Model
{
    use HasFactory;
    protected $table = 'guardian_profile_images';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'guardian_profiles_id',
        'image_path',
        'which_image',
        'is_examination'
    ];

    public function guardianProfile()
    {
        return $this->belongsTo(GuardianProfile::class, 'guardian_profiles_id');
    }
}
