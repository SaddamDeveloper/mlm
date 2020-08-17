<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\ShoppingCategory;
class ShoppingProduct extends Model
{
    protected $table = 'shopping_product';

    protected $fillable = [
        'name', 'category_id', 'main_image', 'mrp', 'price', 'short_desc', 'long_desc', 'status', 'category_id as category_name'
    ];

  
   public function category()
   {
       return $this->belongsTo('App\Model\ShoppingCategory', 'category_id', 'id');
   }
   
}
