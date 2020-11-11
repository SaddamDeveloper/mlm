<?php

namespace App\Http\Controllers\Admin\Reward;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index(){
        return view('admin.reward.index');
    }
}
