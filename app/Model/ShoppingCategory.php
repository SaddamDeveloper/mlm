<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShoppingCategory extends Model
{
    protected $table = 'shopping_category';

    protected $fillable = [
        'name', 'parent_id', 'status',
    ];

    public function product()
    {
        return $this->hasMany('App\Model\ShoppingProduct', 'category_id', 'id');
    }
}
