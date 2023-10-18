<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SlideModel;
use Illuminate\Http\Request;

class ShopDetailsController extends Controller
{
    //




    public function calculateTotalPrice($cart):float{
        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['qty'];
        }
        return $total;
    }

    public function shopDetailsIndex(){
        $products = Product::where('product_category_id','4')->orderBy('created_at','asc')->limit(4)->get();
        $producttop = Product::where('product_category_id','4')->orderBy('created_at','asc')->limit(1)->get();
        $slideAlls = SlideModel::where('status','0')->limit(1)->get();
        $cart = session()->get('cart') ?? [];

        return view('client.pages.shopdetails',[
            'products'=>$products,
            'slideAlls'=>$slideAlls,
            'producttop'=>$producttop,
            'cart' => $cart,
        ]);
    }


}
