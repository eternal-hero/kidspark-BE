<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KidsparkRevenue extends Model
{
    use HasFactory;
    protected $table = 'kidspark_revenues';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }
}
