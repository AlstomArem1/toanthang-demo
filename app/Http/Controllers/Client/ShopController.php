<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SlideModel;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function shopIndex(Request $request){
        $keyword = $request->keyword ?? '';
        $status = $request->status ?? '';

        $sortBy = $request->sortBy ?? 'latest';
        $sort = ($sortBy === 'oldest') ? 'asc' : 'desc';


        $filter = [];//'select * from product_categories  where name like ? order by created_at (desc or asc) limit ?,?'
        if(!empty($keyword)){
            $filter[]=['name','like', '%'.$keyword.'%'];
        }
        if($status !== ''){
            $filter[] = ['status', $status];
        }

        $product_categories = ProductCategory::all();
        $productoff = Product::orderBy('created_at','asc')->limit(6)->get();
        $products = Product::where($filter)->orderBy('price', $sort)->paginate(8);
        $productop = Product::where('product_category_id','2')->orderBy('created_at','asc')->limit(3)->get();
        $productop1 = Product::where('product_category_id','4')->orderBy('created_at','asc')->limit(3)->get();
        $slides = SlideModel::where('status','0')->limit(1)->get();

        return view('client.pages.shop',[
            'product_categories'=>$product_categories,
            'products'=>$products,
            'productoff' => $productoff,
            'productop' => $productop,
            'productop1' => $productop1,
            'slides' => $slides,
            'keyword' => $keyword,
            'sortBy' => $sortBy
        ]);


    }

}
