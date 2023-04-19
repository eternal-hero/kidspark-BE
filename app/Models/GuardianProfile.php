<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardianProfile extends Model
{
    use HasFactory;
    protected $table = 'guardian_profiles';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'guardian_user_id',
        'inoculation_status_id',
        'title',
        'self_introduction',
        'near_line',
        'near_station',
        'means',
        'travel_time',
        'is_publish',
        'rule',
        'way_to_get_home'
    ];

    public function guardianUser() {
        return $this->belongsTo(GuardianUser::class);
    }
    public function guardianProfileImage() {
        return $this->hasMany(GuardianProfileImage::class, 'guardian_profiles_id');
    }
}
