<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }
    public function reviewerUser()
    {
        $reviewe_type = config('api.common.reviewer_type');
        switch($this->reviewer_type){
            case $reviewe_type['guardian']:
                return $this->belongsTo(GuardianUser::class,'reviewer_id');
                break;
            case $reviewe_type['supporter']:
                return $this->belongsTo(SupporterUser::class,'reviewer_id');
                break;
            default:
                return;
                break;
        }
    }
}
