<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReserveOption extends Model
{
    use HasFactory;
    protected $table = 'reserve_options';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }
    public function supporterOption()
    {
        return $this->belongsTo(SupporterOption::class,'option_id');
    }
}
