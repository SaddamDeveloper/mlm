<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportantNotice extends Model
{
    protected $table = 'important_notices';
    protected $fillable = ['title', 'description', 'status'];
}
