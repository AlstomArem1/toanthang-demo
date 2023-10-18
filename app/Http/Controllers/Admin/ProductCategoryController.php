<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProductCategoryController extends Controller
{
    public function index(Request $request){
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


        $productCategories = ProductCategory::where($filter)
        ->orderBy('created_at',$sort)
        ->paginate(config('my-config.item-per-pages'));
        return view('admin.pages.Category.list',[
            'productCategories' => $productCategories,
            'keyword' => $keyword,
            'sortBy' => $sortBy

        ]);
    }

    public function add(){
        return view('admin.pages.Category.create');

    }

    public function store(StoreProductCategoryRequest $request){
         //Eloquent
         $productCategory = new ProductCategory;
         $productCategory->name = $request->name;
         $productCategory->status = $request->status;
         $check = $productCategory->save();

        $message = $check ? 'Tao thanh cong' : 'Tao that bai';

        //Session flash
        return redirect()->route('admin.category.index')->with('message', $message);

    }

    public function detail(ProductCategory $productCategory){
        return view('admin.pages.Category.detail',['productCategory' => $productCategory]);
    }

    public function update(StoreProductCategoryRequest $request, ProductCategory $productCategory){
        $productCategory->name = $request->name;
        $productCategory->status = $request->status;
        $check = $productCategory->save();

        $message = $check > 0 ? 'Tao thanh cong' : 'Tao that bai';

        return redirect()->route('admin.category.index')->with('message',$message);
    }

    public function destroy(ProductCategory $productCategory){
        $check = $productCategory->delete();
        $message = $check > 0 ? 'Xoa thanh cong' : 'Xoa that bai';

        return redirect()->route('admin.category.index')->with('message',$message);

    }

}

