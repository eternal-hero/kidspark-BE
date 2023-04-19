<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupporterSchedule extends Model
{
    use HasFactory;
    protected $table = 'supporter_schedules';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    public function supporterUser()
    {
        return $this->belongsTo(SupporterUser::class);
    }
}
