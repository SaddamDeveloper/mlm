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
use App\Gallery;
use App\Model\ShoppingCategory;
use App\Models\Legal;
use App\Models\VideoGallery;
use App\Models\VideoPlan;
class WebsiteController extends Controller
{
    public function index()
    {
        $slider = ShoppingSlider::where('status', 1)->orderBy('created_at', 'DESC')->get();
        $product = ShoppingProduct::where('section', 1)->where('status', 1)->orderBy('created_at', 'DESC')->get();
        $product1 = ShoppingProduct::where('section', 2)->where('status', 1)->orderBy('created_at', 'ASC')->get();
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
    public function videoPlan()
    {
        $video_plan = VideoPlan::orderBy('created_at', 'DESC')->paginate(8);
        return view('web.video_plan', compact('video_plan'));
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

    public function productList()
    {
        $categories = ShoppingCategory::orderBy('created_at', 'DESC')->where('status', 1)->take(5)->get();
        $products = ShoppingProduct::where('section', 1)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(8);
        return view('web.product.product-list', compact('products', 'categories'));
    }
    public function productDetail($id)
    {
        try{
            $id = decrypt($id);
        }catch(DecryptException $e) {
            abort(404);
        }
        $product_detail = ShoppingProduct::find($id);
        $related_product = ShoppingProduct::orderBy('created_at', 'DESC')->where('status', 1)->where('section', 1)->paginate(10);

        return view('web.product.product-detail', compact('product_detail', 'related_product'));
    }

    public function productData(Request $request)
    {
        if($request->ajax()){
            $id = $request->get('id');
            if(!empty($id)) {
                $product_data = ShoppingProduct::find($id);
                $output = '<div class="row">
                <div class="col-lg-5">
                    <div class="product-large-slider">
                        <div class="pro-large-img img-zoom">
                            <img src="'.asset('web/img/product/'.$product_data->main_image).'" alt="product-details" />
                        </div>
                    </div>
                   
                </div>
                <div class="col-lg-7">
                    <div class="product-details-des">
                        <div class="manufacturer-name">
                            <a href="">SSSDREAMLIFE</a>
                        </div>
                        <h3 class="product-name">'.$product_data->name.'</h3>
                        <div class="price-box">
                            <span class="price-regular">₹'.number_format($product_data->price, 2).'</span>
                            <span class="price-old"><del>₹'.number_format($product_data->mrp, 2).'</del></span>
                        </div>
                        <h5 class="offer-text"><strong>Hurry up</strong>! offer ends in:</h5>
                        <div class="product-countdown" data-countdown="2022/02/20"></div>
                        <p class="pro-desc">'.$product_data->long_desc.'</p>
                        <div class="like-icon">
                            <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                            <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                            <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                            <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                        </div>
                    </div>
                </div>
            </div>';
            return $output;
            }else{
                return 1;
            }
        }
    }
    
    public function image()
    {
        $gallery = Gallery::orderBy('created_at', 'DESC')->paginate(8);
        return view('web.gallery.image', compact('gallery'));
    }

    public function categoryFilter($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $products = ShoppingProduct::orderBy('created_at', 'DESC')->where('status', 1)->where('category_id', $id)->paginate(10);
        return view('web.product.product-list', compact('products'));
    }

    public function legalDocs()
    {
        $legal = Legal::orderBy('created_at', 'DESC')->paginate(8);
        return view('web.legal', compact('legal'));
    }
    
    public function video() {
        $video_gallery = VideoGallery::orderBy('created_at', 'DESC')->paginate(8);
        return view('web.gallery.video', compact('video_gallery'));
    }
}
