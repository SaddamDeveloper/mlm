<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShoppingProductImage extends Model
{
    protected $table = 'shopping_product_image';

    protected $fillable = [
        'image', 'p_id'
    ];
}
