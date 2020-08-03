<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';
    protected $primary_key = 'id';
    protected $fillable = ['id', 'package_name', 'user_id', 'login_id', 'added_by'];

    public function member()
    {
        return $this->belongsTo('App\Member', 'user_id', 'id');
    }
}
