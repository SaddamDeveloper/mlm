<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Legal extends Model
{
    protected $table = 'legals';
    protected $fillable = ['photo', 'status'];

}
