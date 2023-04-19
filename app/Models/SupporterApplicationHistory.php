<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupporterApplicationHistory extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = ['id'];

    public function supporterApplicationDetail()
    {
        return $this->belongsTo(SupporterApplicationDetail::class, 'application_id', 'id');
    }
}
