<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;
    protected $table = 'chat_rooms';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    
    public function guardianUser()
    {
        return $this->belongsTo(GuardianUser::class,'guardian_user_id');
    }
    public function supporterUser()
    {
        return $this->belongsTo(SupporterUser::class,'supporter_user_id');
    }
    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }
    public function chat()
    {
        return $this->hasMany(Chat::class);
    }
}
