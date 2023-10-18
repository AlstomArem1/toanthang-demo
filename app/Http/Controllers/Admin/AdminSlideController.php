<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SlideModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AdminSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $slides =SlideModel::withTrashed()->paginate(6);
        return view('admin.pages.Slide.list',['slides'=>$slides]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function Slug(Request $request)
    {
        //
        return response()->json(['slug' => Str::slug($request->name,'-')]);

    }
    public function create()
    {
        //
        return  view('admin.pages.Slide.create');
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(SlideModel $slideModel,Request $request)
    {
        //


        if($request->hasFile('image')){
            $fileOriginalName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($fileOriginalName, PATHINFO_FILENAME);
            $fileName .= '_'.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'), $fileName);

        }
        $check = DB::table('slides')->insert([
            "name" => $request->name,
            "slug" => $request->slug,
            "description" => $request->description,
            "status" => $request->status,
            "image" => $fileName ?? null,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()

        ]);



         $message = $check ? 'Tao thanh cong' : 'Tao that bai';
         //Session flash
         return redirect()->route('admin.slide.index')->with('message', $message);
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $slide = DB::table('slides')->find($id);
        $image = $slide->image;
        if(!is_null($image) && file_exists('images/'.$image)){
            unlink('images/'.$image);
        }

        // $request = DB::table('products')->where('id','=',$id)->delete();
        $result = DB::table('slides')->delete($id);
        $message = $result ? 'xoa san phan thanh cong' : 'xoa san phan that bai';
        //session flash
        return redirect()->route('admin.slide.index')->with('message', $message);
    }
}
