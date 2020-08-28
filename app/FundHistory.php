<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FundHistory extends Model
{
    protected $table = 'fund_histories';
    protected $fillable = ['amount', 'user_id', 'comment', 'status'];

    public function user()
    {
        return $this->belongsTo('App\Member', 'user_id', 'id');
    }
}
