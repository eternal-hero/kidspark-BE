<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimatedAmount extends Model
{
    use HasFactory;
    protected $table = 'estimated_amounts';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    public function jobRequest()
    {
        return $this->hasOne(JobRequest::class);
    }
}
