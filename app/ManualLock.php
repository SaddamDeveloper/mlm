<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManualLock extends Model
{
    protected $table = 'lock_table';
    protected $fillable = ['joining'];
    protected $primary_key = 'id';
}
