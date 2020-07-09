<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Tree extends Model
{
    protected $table = 'trees';
    protected $primary_key = 'id';
    protected $fillable = [
        'user_id', 'left_id', 'right_id', 'parent_id', 'registered_by', 'left_count', 'right_count', 'total_left_count', 'total_right_count', 'total_pair', 'parent_leg'
    ];

    public function member()
    {
        return $this->belongsTo('App\Member', 'user_id', 'id');
    }
}
