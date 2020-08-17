<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShoppingProductSpecification extends Model
{
    protected $table = 'shopping_product_specification';

    protected $fillable = [
        'p_id', 'name', 'value'
    ];
}
