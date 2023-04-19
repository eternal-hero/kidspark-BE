<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobReservationSummary extends Model
{
    use HasFactory;
    protected $table = 'job_reservation_summaries';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }
    public function jobMonitaring()
    {
        if($this->monitaring_id){
            return $this->belongsTo(JobMonitaring::class,'monitaring_id');
        }else{
            return;
        }
    }
}
