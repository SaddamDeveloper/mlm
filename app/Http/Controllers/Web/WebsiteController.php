<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ShoppingSlider;
use App\Model\ShoppingProduct;
use App\Frotend;
use App\Rewards;
use Carbon\Carbon;
use App\Tree;
class WebsiteController extends Controller
{
    public function index()
    {
        $slider = ShoppingSlider::orderBy('created_at', 'DESC')->get();
        $product = ShoppingProduct::where('section', 1)->orderBy('created_at', 'DESC')->get();
        $product1 = ShoppingProduct::where('section', 2)->orderBy('created_at', 'ASC')->get();
        return view('web.index', compact('slider', 'product', 'product1'));
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
        $reward_achiever = Rewards::orderBy('created_at', 'DESC')->paginate(10);
        return view('web.reward', compact('reward_achiever'));
    }
    public function product()
    {
        $product = ShoppingProduct::where('section', 2)->orderBy('created_at', 'DESC')->paginate(4);
        return view('web.product', compact('product'));
    }
    public function rankAchiever()
    {
        $month = Carbon::now()->format('F');
        $rank_achiever = Tree::orderBy('created_at', 'DESC')->paginate(10);
        return view('web.rank_achiever', compact('rank_achiever', 'month'));
    }
    public function rewardAchiever(){
        return view('web.reward_achiever');
    }
    public function contact()
    {
        return view('web.contact');
    }
    public function thanks($token)
    {
        try {
            $token = decrypt($token);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        if($token){
            $success = 'Registration Successfull';
            return view('web.thanks', compact('success'));
        }
    }
}
