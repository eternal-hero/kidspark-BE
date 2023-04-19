<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;
    protected $table = 'children';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'guardian_user_id',
        'first_name',
        'last_name',
        'first_kana',
        'last_kana',
        'gender',
        'nickname',
        'birthday',
        'allergy',
        'chronic_disease',
        'other'
    ];
    protected $guarded = [];

    public function job()
    {
        return $this->belongsToMany(Job::class,'reserve_children','child_id','job_id');
    }
}
