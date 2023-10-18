<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AdminBlogModel;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SlideModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index(Request $request){
        $keyword = $request->keyword ?? '';
        $filter = [];//'select * from product_categories  where name like ? order by created_at (desc or asc) limit ?,?'
        if(!empty($keyword)){
            $filter[]=['name','like', '%'.$keyword.'%'];
        }


        $product_categories = ProductCategory::all();
        $blogs = AdminBlogModel::orderBy('created_at','asc')->limit(3)->get();
        $products = Product::orderBy('created_at','desc')->limit(8)->get();
        $productop = Product::where('product_category_id','2')->orderBy('created_at','asc')->limit(3)->get();
        $productop1 = Product::where('product_category_id','4')->orderBy('created_at','asc')->limit(3)->get();

        $slide1 = SlideModel::where('status','1')->limit(1)->get();

        return view('client.pages.home',[
        'products' => $products,
        'product_categories' => $product_categories,
        'blogs' => $blogs,
        'productop' => $productop,
        'productop1' => $productop1,
        'slide1' => $slide1,
        'keyword' => $keyword,

    ]);

    }


}
