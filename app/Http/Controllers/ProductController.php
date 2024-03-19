<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        return view('admin.product.create');
    }


    public function store(Request $request)
    {

//        'category_id','name','more','price','img','count','status'
        if ($request->img){

        $uuid = Str::uuid()->toString();
        $fileName = $uuid . '-' . time() . '.' . $request->img->getExtension();
        $request->img->move(public_path('../public/storage/galereya/'), $fileName);
        if ($request->count>0) {
            Product::create([
                'category_id' => $request->category_id,
                'img' => $fileName,
                'name' => $request->name,
                'more' => $request->more,
                'price' => $request->price,
                'count' => $request->count,
                'type' => 0,
                'status' => $request->status,
                'code' => $request->code
            ]);
        }else{
            Product::create([
                'category_id' => $request->category_id,
                'img' => $fileName,
                'name' => $request->name,
                'more' => $request->more,
                'price' => $request->price,
                'miqdori' => $request->miqdori,
                'status' => $request->status,
                'type' => 1,
                'code' => $request->code
            ]);
        }}else{
            if ($request->count>0) {
                Product::create([
                    'category_id' => $request->category_id,
                    'name' => $request->name,
                    'more' => $request->more,
                    'price' => $request->price,
                    'count' => $request->count,
                    'type' => 0,
                    'status' => $request->status,
                    'code' => $request->code
                ]);
            }else{
                Product::create([
                    'category_id' => $request->category_id,
                    'name' => $request->name,
                    'more' => $request->more,
                    'price' => $request->price,
                    'miqdori' => $request->miqdori,
                    'status' => $request->status,
                    'type' => 1,
                    'code' => $request->code
                ]);
            }

        }
        return redirect()->route('product.index');
    }


    public function show($id)
    {
        //
    }


    public function edit(Product $product)
    {
        return view('admin.product.edit',['product'=>$product]);
    }


    public function update(Request $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('product.index')->with('success','O\'zgarish saqlandi');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }
}
