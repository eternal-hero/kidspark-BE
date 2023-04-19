<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $table = 'jobs';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    
    public function guardianUser()
    {
        return $this->belongsTo(GuardianUser::class,'guardian_user_id');
    }
    public function supporterUser()
    {
        return $this->belongsTo(SupporterUser::class,'supporter_user_id');
    }

    public function jobRequest()
    {
        return $this->hasOne(JobRequest::class,'job_id');
    }
    public function reserveOption()
    {
        return $this->hasMany(ReserveOption::class,'job_id');
    }
    public function reserveChild()
    {
        return $this->belongsToMany(Child::class,'reserve_children','job_id','child_id');
    }
    public function jobMonitaring()
    {
        return $this->hasOne(JobMonitaring::class,'job_id');
    }
    public function jobCancel()
    {
        return $this->hasOne(JobCancel::class,'job_id');
    }
    public function preQuotation()
    {
        return $this->hasOne(PreQuotation::class,'job_id');
    }
    public function completionReport()
    {
        return $this->hasOne(CompletionReport::class,'job_id');
    }
    public function jobReservationSummary()
    {
        return $this->hasOne(JobReservationSummary::class,'job_id');
    }
    public function jobSupportRecord()
    {
        return $this->hasOne(JobSupportRecord::class,'job_id');
    }
    public function kidsparkRevenue()
    {
        return $this->hasOne(KidsparkRevenue::class,'job_id');
    }
    public function review()
    {
        return $this->hasMany(Review::class,'job_id');
    }
    public function chatRoom()
    {
        return $this->hasMany(ChatRoom::class);
    }
}
