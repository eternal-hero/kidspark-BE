<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildbirthCareSupport extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $guarded = ['id'];

    public function supporterUser()
    {
        return $this->belongsTo(SupporterUser::class);
    }

    public function supporterSettingsManagement()
    {
        return $this->belongsTo(SupporterSettingsManagement::class, 'settings_id', 'id');
    }
}
