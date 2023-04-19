<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $table = 'points';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'guardian_user_id',
        'job_reservation_id',
        'content',
        'point',
        'point_on'
    ];
}
