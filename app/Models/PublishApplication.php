<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishApplication extends Model
{
    use HasFactory;
    protected $table = 'publish_applications';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'guardian_user_id',
        'title',
        'type',
        'is_single',
        'childcare_on',
        'support_time_start',
        'support_time_end',
        'detail',
        'fee_limit',
        'transportation_expenses_limit',
        'place',
        'near_station',
        'period_at',
        'status'
    ];
}
