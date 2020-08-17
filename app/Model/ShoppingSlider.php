<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShoppingSlider extends Model
{
    protected $table = 'shopping_sliders';
    protected $fillable = [
        'slider_name', 'slider_image'
    ];
}
