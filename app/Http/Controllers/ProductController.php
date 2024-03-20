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
        if ($request->img5){


            $uuid = Str::uuid()->toString();
            $fileName = $uuid . '-' . time() . '.' . $request->img->getExtension();
            $request->img->move(public_path('../public/storage/galereya/'), $fileName);
            $uuid2 = Str::uuid()->toString();
            $fileName2 = $uuid2 . '-' . time() . '.' . $request->img2->getExtension();
            $request->img2->move(public_path('../public/storage/galereya/'), $fileName2);
            $uuid3 = Str::uuid()->toString();
            $fileName3 = $uuid3 . '-' . time() . '.' . $request->img3->getExtension();
            $request->img3->move(public_path('../public/storage/galereya/'), $fileName3);
            $uuid4 = Str::uuid()->toString();
            $fileName4 = $uuid4 . '-' . time() . '.' . $request->img4->getExtension();
            $request->img4->move(public_path('../public/storage/galereya/'), $fileName4);
            $uuid5 = Str::uuid()->toString();
            $fileName5 = $uuid5 . '-' . time() . '.' . $request->img5->getExtension();
            $request->img5->move(public_path('../public/storage/galereya/'), $fileName5);
            if ($request->count>0) {
                Product::create([
                    'category_id' => $request->category_id,
                    'img' => $fileName,
                    'img2' => $fileName2,
                    'img3' => $fileName3,
                    'img4' => $fileName4,
                    'img5' => $fileName5,
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
                    'img2' => $fileName2,
                    'img3' => $fileName3,
                    'img4' => $fileName4,
                    'img5' => $fileName5,
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
        elseif ($request->img4){


            $uuid = Str::uuid()->toString();
            $fileName = $uuid . '-' . time() . '.' . $request->img->getExtension();
            $request->img->move(public_path('../public/storage/galereya/'), $fileName);
            $uuid2 = Str::uuid()->toString();
            $fileName2 = $uuid2 . '-' . time() . '.' . $request->img2->getExtension();
            $request->img2->move(public_path('../public/storage/galereya/'), $fileName2);
            $uuid3 = Str::uuid()->toString();
            $fileName3 = $uuid3 . '-' . time() . '.' . $request->img3->getExtension();
            $request->img3->move(public_path('../public/storage/galereya/'), $fileName3);
            $uuid4 = Str::uuid()->toString();
            $fileName4 = $uuid4 . '-' . time() . '.' . $request->img4->getExtension();
            $request->img4->move(public_path('../public/storage/galereya/'), $fileName4);
            if ($request->count>0) {
                Product::create([
                    'category_id' => $request->category_id,
                    'img' => $fileName,
                    'img2' => $fileName2,
                    'img3' => $fileName3,
                    'img4' => $fileName4,
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
                    'img2' => $fileName2,
                    'img3' => $fileName3,
                    'img4' => $fileName4,
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
        elseif ($request->img3){


            $uuid = Str::uuid()->toString();
            $fileName = $uuid . '-' . time() . '.' . $request->img->getExtension();
            $request->img->move(public_path('../public/storage/galereya/'), $fileName);
            $uuid2 = Str::uuid()->toString();
            $fileName2 = $uuid2 . '-' . time() . '.' . $request->img2->getExtension();
            $request->img2->move(public_path('../public/storage/galereya/'), $fileName2);
            $uuid3 = Str::uuid()->toString();
            $fileName3 = $uuid3 . '-' . time() . '.' . $request->img3->getExtension();
            $request->img3->move(public_path('../public/storage/galereya/'), $fileName3);
            if ($request->count>0) {
                Product::create([
                    'category_id' => $request->category_id,
                    'img' => $fileName,
                    'img2' => $fileName2,
                    'img3' => $fileName3,
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
                    'img2' => $fileName2,
                    'img3' => $fileName3,
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
        elseif ($request->img2){


            $uuid = Str::uuid()->toString();
            $fileName = $uuid . '-' . time() . '.' . $request->img->getExtension();
            $request->img->move(public_path('../public/storage/galereya/'), $fileName);
            $uuid2 = Str::uuid()->toString();
            $fileName2 = $uuid2 . '-' . time() . '.' . $request->img2->getExtension();
            $request->img2->move(public_path('../public/storage/galereya/'), $fileName2);
            if ($request->count>0) {
                Product::create([
                    'category_id' => $request->category_id,
                    'img' => $fileName,
                    'img2' => $fileName2,
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
                    'img2' => $fileName2,
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
        elseif ($request->img){

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
        }
        }else{
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
