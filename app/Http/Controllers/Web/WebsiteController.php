<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('web.index');
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
