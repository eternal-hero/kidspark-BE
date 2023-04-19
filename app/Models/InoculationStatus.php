<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InoculationStatus extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = ['id'];

    protected $table = 'inoculation_status';

    public function supporterProfile()
    {
        return $this->hasOne(SupporterProfile::class);
    }
    public function guardianProfile()
    {
        return $this->hasOne(GuardianProfile::class);
    }
}
