<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ShoppingCategory;
use Carbon\Carbon;
use DataTables;
use Intervention\Image\Facades\Image;
use File;
use App\Model\ShoppingProduct;
use App\Model\ShoppingSlider;
class ShoppingProductController extends Controller
{
    public function shoppingSlider()
    {
        return view('admin.shopping_slider');
    }

    public function addShoppingSlider()
    {
        return view('admin.add_shopping_slider');
    }
    public function ShoppingSliderList()
    {
        return datatables()->of(ShoppingSlider::get())
        ->addIndexColumn()
        ->addColumn('slider_image', function($row){
            if($row->slider_image){
                $slider_image = '<img src="'.asset("web/img/slider/thumb/".$row->slider_image).'" width="100"/>';
            }
            return $slider_image;
        })
        ->addColumn('action', function($row){
            if($row->status == '1'){
                $action = '<a href="'.route('admin.shopping_slider_status', ['sId' => encrypt($row->id), 'status'=> encrypt(2)]).'" class="btn btn-danger">Disable</a>';
            }else{
                $action = '<a href="'.route('admin.shopping_slider_status', ['sId' => encrypt($row->id), 'status'=> encrypt(1)]).'" class="btn btn-primary">Enable</a>';
            }
                $action .= '<a  href="'.route('admin.shopping_slider_edit', ['id' => encrypt($row->id)]).'" class="btn btn-info">Edit</a>';
            return $action;
        })
        ->rawColumns(['action', 'slider_image'])
        ->make(true);
    }

    public function storeShoppingSlider(Request $request)
    {
        $this->validate($request, [
            'slider_name'   => 'required',
            'offer' => 'required',
            'banner_title' => 'required',
            'banner_subtitle' => 'required',
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $slider_name = $request->input('slider_name');
        $image = null;
        if($request->hasfile('slider_image')){
            $image_array = $request->file('slider_image');
            $image = $this->sliderImageInsert($image_array, $request, 1);
        }
        $offer = $request->input('offer');
        $banner_title = $request->input('banner_title');
        $banner_subtitle = $request->input('banner_subtitle');

        $shopping_slider_insert = new ShoppingSlider;
        $shopping_slider_insert->slider_name = $slider_name;
        $shopping_slider_insert->slider_image = $image;
        $shopping_slider_insert->offer = $offer;
        $shopping_slider_insert->banner_title = $banner_title;
        $shopping_slider_insert->banner_subtitle = $banner_subtitle;

        if($shopping_slider_insert->save()){
            return redirect()->back()->with('message', 'Slider Inserted Successfully!');
        }else {
            return redirect()->back()->with('error', 'Something Went Wrong Please Try Again');
        }
    }
    public function ShoppingSliderEdit($pId){
        try{
            $id = decrypt($pId);
        }catch(DecryptException $e) {
            abort(404);
        }
        $product = ShoppingSlider::find($id);
        return view('admin.edit_shopping_slider', compact('product'));
    }

    public function ShoppingSliderStatus($sId,$statusId){
        try{
            $id = decrypt($sId);
            $sId = decrypt($statusId);
        }catch(DecryptException $e) {
            abort(404);
        }

        $shopping_slider_status = ShoppingSlider::where('id', $id)
            ->update(['status' => $sId, 'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()]);
       if($shopping_slider_status){
           return redirect()->back()->with('message','Status Updated Successfully!');
       }
    }

    public function ShoppingSliderUpdate(Request $request, $pId)
    {   
        try{
            $id = decrypt($pId);
        }catch(DecryptException $e) {
            abort(404);
        }
        $this->validate($request, [
            'slider_name'   => 'required',
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        
        $shopping_slider = ShoppingSlider::find($id);
        $shopping_slider->slider_name = $slider_name;
        $shopping_slider->slider_image = $slider_image;
        $update = $shopping_slider->save();

        if($update){
            return redirect()->back()->with('message','Product Slider Successfully!');
        }
    }

    public function shoppingProduct(){
        return view('admin.shopping_product');
    }

    public function addShoppingProduct(){
        $category = ShoppingCategory::get();
        return view('admin.add_shopping_product', compact('category'));
    }

    public function storeShoppingProduct(Request $request){
        $this->validate($request, [
            'name'   => 'required',
            'category' => 'required',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mrp' => 'required|min:1|numeric',
            'price'   => 'required|min:1|numeric'
        ]);

        $name = $request->input('name');
        $category = $request->input('category');
        $image = null;
        if($request->hasfile('main_image')){
            $image_array = $request->file('main_image');
            $image = $this->imageInsert($image_array, $request, 1);
        }
        $mrp = $request->input('mrp');
        $price = $request->input('price');
        $short_desc = $request->input('short_desc');
        $long_desc = $request->input('long_desc');

        $shopping_product_insert = new ShoppingProduct;
        $shopping_product_insert->name = $name;
        $shopping_product_insert->category_id = $category;
        $shopping_product_insert->main_image = $image;
        $shopping_product_insert->mrp = $mrp;
        $shopping_product_insert->price = $price;
        $shopping_product_insert->short_desc = $short_desc;
        $shopping_product_insert->long_desc = $long_desc;

        $save = $shopping_product_insert->save();
        if($save){
            return redirect()->back()->with('message','Product Added Successfully!');
        }
    }

    public function ShoppingProductList(){
        return datatables()->of(ShoppingProduct::get())
        ->addIndexColumn()
        ->addColumn('category_name', function($row){
            if($row->id){
                $category_name = ShoppingProduct::find($row->id)->category->name;
            }
            return $category_name;
        })
        ->addColumn('main_image', function($row){
            if($row->main_image){
                $main_image = '<img src="'.asset("web/img/product/thumb/".$row->main_image).'" width="50"/>';
            }
            return $main_image;
        })
        ->addColumn('action', function($row){
            if($row->status == '1'){
                $action = '<a href="'.route('admin.shopping_product_status', ['pId' => encrypt($row->id), 'status'=> encrypt(2)]).'" class="btn btn-danger">Disable</a>';
            }else{
                $action = '<a href="'.route('admin.shopping_product_status', ['pId' => encrypt($row->id), 'status'=> encrypt(1)]).'" class="btn btn-primary">Enable</a>';
            }
                $action .= '<a  href="'.route('admin.shopping_product_edit', ['id' => encrypt($row->id)]).'" class="btn btn-info">Edit</a>';
            return $action;
        })
        ->rawColumns(['action', 'category_name', 'main_image'])
        ->make(true);
    }

    public function ShoppingProductEdit($pId){
        try{
            $id = decrypt($pId);
        }catch(DecryptException $e) {
            abort(404);
        }
        $product = ShoppingProduct::find($id);
        $category = ShoppingCategory::find($id);
        return view('admin.edit_shopping_product', compact('product'));
    }

    public function ShoppingProductStatus($pId,$statusId){
        try{
            $id = decrypt($pId);
            $sId = decrypt($statusId);
        }catch(DecryptException $e) {
            abort(404);
        }

        $shopping_product_status = ShoppingProduct::where('id', $id)
            ->update(['status' => $sId, 'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()]);
       if($shopping_product_status){
           return redirect()->back()->with('message','Status Updated Successfully!');
       }
    }

    public function ShoppingProductUpdate(Request $request, $pId){
        try{
            $id = decrypt($pId);
        }catch(DecryptException $e) {
            abort(404);
        }
        $this->validate($request, [
            'name'   => 'required',
            'category' => 'required',
            'mrp' => 'required|min:1|numeric',
            'price'   => 'required|min:1|numeric'
        ]);
        
        $shopping_product = ShoppingProduct::find($id);
        $shopping_product_insert->name = $name;
        $shopping_product_insert->category_id = $category;
        $shopping_product_insert->main_image = $image;
        $shopping_product_insert->mrp = $mrp;
        $shopping_product_insert->price = $price;
        $shopping_product_insert->short_desc = $short_desc;
        $shopping_product_insert->long_desc = $long_desc;
        $update = $shopping_product->save();

        if($update){
            return redirect()->back()->with('message','Product Updated Successfully!');
        }

    }
    //SHOPPING CATEGORY
    public function shoppingCategory(){
        return view('admin.shopping_category');
    }

    public function addShoppingCategory(){
        return view('admin.add_shopping_category');
    }

    public function storeShoppingCategory(Request $request){
        $this->validate($request, [
            'category'   => 'required'
        ]);
        
        $shopping_category = new ShoppingCategory;
        $shopping_category->name = $request->input('category');
        $shopping_category->parent_id = NULL;
        $shopping_category->status = '1';
        $shopping_category->created_at = Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString();

        $save = $shopping_category->save();
        if($save){
            return redirect()->back()->with('message','Category Added Successfully!');
        }
    }

    public function shoppingCategoryList(){
        $category = ShoppingCategory::orderBy('id','DESC');
        return datatables()->of($category->get())
        ->addIndexColumn()
        ->addColumn('action', function($row){
            if($row->status == '1'){
                $action = '<a href="'.route('admin.shopping_category_status', ['pId' => encrypt($row->id), 'status' => encrypt(2)]).'" class="btn btn-danger">Disable</a>';
            }else{
                $action = '<a href="'.route('admin.shopping_category_status', ['pId' => encrypt($row->id), 'status' => encrypt(1)]).'" class="btn btn-primary">Enable</a>';
            }
                $action .= '<a  href="'.route('admin.shopping_category_edit', ['id' => encrypt($row->id)]).'" class="btn btn-info">Edit</a>';
            return $action;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function ShoppingCategoryEdit($pId){
        try{
            $id = decrypt($pId);
        }catch(DecryptException $e) {
            abort(404);
        }
        $category = ShoppingCategory::find($id);
        return view('admin.edit_shopping_category', compact('category'));
    }

    public function ShoppingCategoryUpdate(Request $request, $pId){
        try{
            $id = decrypt($pId);
        }catch(DecryptException $e) {
            abort(404);
        }
        $this->validate($request, [
            'category'   => 'required'
        ]);
        
        $shopping_category = ShoppingCategory::find($id);
        $shopping_category->name = $request->input('category');
        $shopping_category->parent_id = NULL;
        $shopping_category->status = '1';
        $shopping_category->created_at = Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString();

        $update = $shopping_category->save();
        if($update){
            return redirect()->back()->with('message','Category Updated Successfully!');
        }

    }

    public function ShoppingCategoryStatus( $pId,$statusId){
        try{
            $id = decrypt($pId);
            $sId = decrypt($statusId);
        }catch(DecryptException $e) {
            abort(404);
        }

        $cutoff_update = ShoppingCategory::where('id', $id)
            ->update(['status' => $sId, 'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString()]);
       if($cutoff_update){
           return redirect()->back()->with('message','Status Updated Successfully!');
       }
    }

    function imageInsert($image, Request $request, $flag){
        $destination = base_path().'/public/web/img/product/';
        $image_extension = $image->getClientOriginalExtension();
        $image_name = md5(date('now').time()).$flag.".".$image_extension;
        $original_path = $destination.$image_name;
        Image::make($image)->save($original_path);
        $thumb_path = base_path().'/public/web/img/product/thumb/'.$image_name;
        Image::make($image)
        ->resize(300, 400)
        ->save($thumb_path);

        return $image_name;
    }

    function sliderImageInsert($image, Request $request, $flag){
        $destination = base_path().'/public/web/img/slider/';
        $image_extension = $image->getClientOriginalExtension();
        $image_name = md5(date('now').time()).$flag.".".$image_extension;
        $original_path = $destination.$image_name;
        Image::make($image)->save($original_path);
        $thumb_path = base_path().'/public/web/img/slider/thumb/'.$image_name;
        Image::make($image)
        ->resize(300, 400)
        ->save($thumb_path);

        return $image_name;
    }
}
