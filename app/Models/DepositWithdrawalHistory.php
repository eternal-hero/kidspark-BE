<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositWithdrawalHistory extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = ['id'];

    public function supporterUser()
    {
        return $this->belongsTo(SupporterUser::class);
    }
}
