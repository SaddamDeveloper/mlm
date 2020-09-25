<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoPlan extends Model
{
    protected $table = 'video_plans';
    protected $fillable = ['photo', 'youtube_id', 'status'];
}
