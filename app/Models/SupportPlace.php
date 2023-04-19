<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportPlace extends Model
{
    use HasFactory;
    protected $table = 'support_place';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }
    public function supportPlaceImage()
    {
        return $this->hasMany(SupportPlaceImage::class);
    }
}
