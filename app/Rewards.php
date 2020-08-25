<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rewards extends Model
{
    protected $table = 'rewards';
    protected $fillable = ['user_id', 'comment', 'target_bv', 'prize', 'status'];

    public function member()
    {
        return $this->belongsTo('App\Member', 'user_id', 'id');
    }
}
