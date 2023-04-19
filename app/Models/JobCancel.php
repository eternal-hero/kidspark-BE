<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCancel extends Model
{
    use HasFactory;
    protected $table = 'job_cancels';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }
    public function applicantUser()
    {
        switch($this->applicant_type){
            case 0:
                return $this->belongsTo(SupporterUser::class,'applicant_id');
                break;
            case 1:
                return $this->belongsTo(GuardianUser::class,'applicant_id');
                break;
           default:
                return;
                break;
        }
    }
}
