<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $cats=Category::all();
        return view('admin.category.index',['cats'=>$cats]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect()->route('category.index');
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


    public function destroy($id)
    {
        //
    }
}
