<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreQuotation extends Model
{
    use HasFactory;
    protected $table = 'pre_quotations';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }
    public function quotationFeeItem()
    {
        return $this->hasMany(QuotationFeeItem::class,'quotation_id');
    }
}
