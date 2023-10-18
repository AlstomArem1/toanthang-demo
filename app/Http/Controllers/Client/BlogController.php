<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\AdminBlogModel;
use App\Models\ProductCategory;
use App\Models\SlideModel;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //

    public function indexBlog(Request $request){

        $keyword = $request->keyword ?? '';
        $filter = [];//'select * from product_categories  where name like ? order by created_at (desc or asc) limit ?,?'
        if(!empty($keyword)){
            $filter[]=['name','like', '%'.$keyword.'%'];
        }
        $categoryid = ProductCategory::all();
        $blogs = AdminBlogModel::where($filter)->orderBy('created_at','desc')->paginate(4);
        $blogst = AdminBlogModel::orderBy('created_at','desc')->limit(3)->get();
        $slides = SlideModel::where('status','0')->limit(1)->get();
        return view('client.pages.blog',[
            'blogs' => $blogs,
            'keyword' => $keyword,
            'slides'=> $slides,
            'categoryid'=> $categoryid,
            'blogst'=> $blogst,
        ]);
    }
}
