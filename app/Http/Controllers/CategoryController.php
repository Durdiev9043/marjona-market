<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index()
    {
        $cats=Category::all();
        $data=Category::whereNull('cat_id')->get();
        return view('admin.category.index',['cats'=>$cats,'data'=>$data]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        if ($request->img){

            $uuid = Str::uuid()->toString();
            $fileName = $uuid . '-' . time() . '.' . $request->img->getExtension();
            $request->img->move(public_path('../public/storage/galereya/'), $fileName);
            Category::create([
                'name'=>$request->name,
                'cat_id'=>$request->cat_id,
                'img'=>$fileName,
            ]);
        }else{
            Category::create($request->all());
        }

        return redirect()->route('category.index')->with('success','Mahsulot kategoryasi saqlandi');
    }


    public function show($id)
    {
        //
    }


    public function edit(Category $category)
    {
//
    }


    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->back();
    }


    public function destroy(Category $category)
    {
        $category->delete();
return redirect()->back()->with('success','Mahsulot kategoryasi ochirildi');
    }
}
