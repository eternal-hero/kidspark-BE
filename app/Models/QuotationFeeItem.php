<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationFeeItem extends Model
{
    use HasFactory;
    protected $table = 'quotation_fee_items';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    public function preQuotation()
    {
        return $this->belongsTo(PreQuotation::class,'quotation_id');
    }
}
