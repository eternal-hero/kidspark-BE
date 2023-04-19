<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportFeeItem extends Model
{
    use HasFactory;
    protected $table = 'report_fee_items';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    public function completionReport()
    {
        return $this->belongsTo(CompletionReport::class,'report_id');
    }
}
