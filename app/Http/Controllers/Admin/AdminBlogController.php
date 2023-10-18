<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminBlogModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use function Laravel\Prompts\table;

class AdminBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $blogs = AdminBlogModel::withTrashed()->paginate(config('my-config.item-per-pages'));
        return view('admin.pages.Blog.list',['blogs' => $blogs]);
    }
    public function Slug(Request $request)
    {
        //
        return response()->json(['slug' => Str::slug($request->name,'-')]);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.pages.Blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, AdminBlogModel $adminBlogModel)
    {
        //
        if($request->hasFile('image')){
            $fileOriginalName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileOriginalName, PATHINFO_FILENAME);
            $fileName .= '_'.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $fileName);

        }

        // $adminBlogModel->name = $request->name;
        // $adminBlogModel->slug = $request->slug;
        // $adminBlogModel->short_description = $request->short_description;
        // $adminBlogModel->shipping = $request->shipping;
        // $adminBlogModel->information = $request->information;
        // $adminBlogModel->image = $fileName;
        // $adminBlogModel->status = $request->status;
        // $adminBlogModel->created_at = Carbon::now();
        // $adminBlogModel->updated_at = Carbon::now();

        $check = DB::table('blogs')->insert([
            "name" => $request->name,
            "slug" => $request->slug,
            "short_description" => $request->short_description,
            "information" => $request->information,
            "shipping" => $request->shipping,
            "status" => $request->status,
            "image" => $fileName ?? null,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()

        ]);


        // $check = $adminBlogModel->save();

        $message = $check ? 'Tao thanh cong' : 'Tao that bai';
         //Session flash
         return redirect()->route('admin.formblog.index')->with('message', $message);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $blog = DB::table('blogs')->find($id);
        return view('admin.pages.Blog.detail',['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog = DB::table('blogs')->find($id);
        $oldImageFileName = $blog->image;


        if($request->hasFile('image')){
            $fileOrginialName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileOrginialName, PATHINFO_FILENAME);
            $fileName .= '_'.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'),  $fileName);

            if(!is_null($oldImageFileName) && file_exists('images/'.$oldImageFileName)){
                unlink('images/'.$oldImageFileName);
            }
        }
        $check = DB::table('blogs')->insert([
            "name" => $request->name,
            "slug" => $request->slug,
            "short_description" => $request->short_description,
            "information" => $request->information,
            "shipping" => $request->shipping,
            "status" => $request->status,
            "image" => $fileName ?? $oldImageFileName,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()

        ]);

        // $blog = AdminBlogModel::find((int)$id);
        // $blog->delete();

        $message = $check ? 'cap nhat san pham thanh cong' : 'cap nhat san pham that bai';

        //session flash
        return redirect()->route('admin.formblog.index')->with('message',$message);
    }
    public function restoreBlog(string $id)
    {
        //
          //Eloquent
          $blog = AdminBlogModel::withTrashed()->find($id);
          $blog->restore();

          return redirect()->route('admin.formblog.index')->with('message','khoi phuc san pham thanh cong');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $blog = DB::table('blogs')->find($id);
        $image = $blog->image;
        if(!is_null($image) && file_exists('images/'.$image)){
            unlink('images/'.$image);
        }

        // $request = DB::table('products')->where('id','=',$id)->delete();
        $result = DB::table('blogs')->delete($id);
        $message = $result ? 'xoa san phan thanh cong' : 'xoa san phan that bai';
        //session flash
        return redirect()->route('admin.formblog.index')->with('message', $message);

    }


}
