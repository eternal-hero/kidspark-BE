<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupporterApplicationDetail extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = ['id'];

    public function supporterUser()
    {
        return $this->belongsTo(SupporterUser::class);
    }

    public function supporterApplicationHistories()
    {
        return $this->hasMany(SupporterApplicationHistory::class, 'application_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($appDetail) {
            $appDetail->supporterApplicationHistories()->delete();
        });
    }
}
