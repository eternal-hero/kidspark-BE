<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRequest extends Model
{
    use HasFactory;
    protected $table = 'job_requests';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }
    public function estimatedAmount()
    {
        return $this->belongsTo(EstimatedAmount::class,'estimated_amounts_id');
    }
}
