<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupporterWorksImage extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function supporterUser()
    {
        return $this->belongsTo(SupporterUser::class);
    }
}
