<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    protected $table = 'video_galleries';
    protected $fillable = ['photo', 'youtube_id', 'status'];
}
