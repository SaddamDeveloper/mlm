<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ShoppingSlider;
use App\Model\ShoppingProduct;
class WebsiteController extends Controller
{
    public function index()
    {
        $slider = ShoppingSlider::orderBy('created_at', 'DESC')->get();
        $product = ShoppingProduct::orderBy('created_at', 'DESC')->get();
        return view('web.index', compact('slider', 'product'));
    }
    public function about()
    {
        return view('web.about');
    }
    public function plan()
    {
        return view('web.plan');
    }
    public function reward()
    {
        return view('web.reward');
    }
}
