<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $cats=Category::all();
        $products=Product::all();
        return view('admin.product.index',['cats'=>$cats,'products'=>$products]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        Product::create($request->all());
        return redirect()->route('product.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
