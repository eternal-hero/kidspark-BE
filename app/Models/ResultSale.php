<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultSale extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = ['id'];

    public function jobReservation()
    {
        return $this->belongsTo(JobReservation::class);
    }
}
