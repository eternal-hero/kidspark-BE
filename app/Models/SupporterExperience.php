<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupporterExperience extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = ['id'];

    protected $table = 'supporter_experience';

    public function supporterUser()
    {
        return $this->belongsTo(SupporterUser::class);
    }
}
