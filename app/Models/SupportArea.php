<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportArea extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = ['id'];

    protected $table = 'support_area';

    public function supporterUser()
    {
        return $this->belongsTo(SupporterUser::class);
    }
}
