<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPackage extends Model
{
    protected $table = 'package';
    protected $fillable = ['package_name', 'price', 'bv', 'status'];
}
