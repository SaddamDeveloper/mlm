<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';
    protected $fillable = [
        'user_id',
        'amount',
        'status'
    ];
    protected $primaryKey = 'id';

    public function member()
    {
        return $this->belongsTo('App\Member', 'user_id', 'id');
    }
}
