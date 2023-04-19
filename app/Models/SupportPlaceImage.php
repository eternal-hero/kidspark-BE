<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportPlaceImage extends Model
{
    use HasFactory;
    protected $table = 'support_place_images';
    public $timestamps = true;
    protected $primaryKey = 'id';
    protected $guarded = [
        'id',
    ];
    public function supportPlace()
    {
        return $this->belongsTo(SupportPlace::class,'support_place_id');
    }
}
