<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardianNotice extends Model
{
    use HasFactory;
    protected $table = 'guardian_notices';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $fillable = [
        'guardian_user_id',
        'is_reserve',
        'is_bbs',
        'is_message',
        'is_kidspark'
    ];
}
