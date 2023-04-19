<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletionReport extends Model
{
    use HasFactory;
    protected $table = 'completion_reports';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }
    public function reportFeeItem()
    {
        return $this->hasMany(ReportFeeItem::class,'report_id');
    }
    public function reportContent()
    {
        return $this->hasMany(ReportContent::class,'report_id');
    }
}
