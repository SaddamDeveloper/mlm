<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Epin extends Model
{
    public function member()
    {
        return $this->belongsTo('App\Member', 'alloted_to', 'id');
    }
}
