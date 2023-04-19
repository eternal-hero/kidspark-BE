<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupporterScheduleAutoRegister extends Model
{
    use HasFactory;
    protected $table = 'supporter_schedule_auto_register';
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
