<?php

namespace App\Http\Controllers;

use App\Models\IncomingProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class IncomingController extends Controller
{

    public function index()
    {
        $data=IncomingProduct::all();
        return view('admin.incoming.index',['data'=>$data]);
    }


    public function create()
    {

        return view('admin.incoming.create');
    }


    public function store(Request $request)
    {
        @session_start();
//        'product_id','count','price','total_price','tel','org','phone','zapas','miqdori'
        foreach ($_SESSION['cart'] as $key=>$value){
            IncomingProduct::create([
                'product_id'=>$value[0]['product_id'],
                'count'=>$value[0]['count'],
                'price'=>$value[0]['price'],
                'total_price'=>$value[0]['total_price'],
                'tel'=>$value[0]['tel'],
                'org'=>$value[0]['org'],
                'miqdori'=>$value[0]['miqdori'],
            ]);

            $product=Product::where('id',$value[0]['product_id'])->first();
            $miqdori=$product->miqdori+$value[0]['miqdori'];
            $count=$product->count+$value[0]['count'];
            $product->update([
                'count'=>$count,
                'miqdori'=>$miqdori,
            ]);
//            DB::table('order_products')->insert([
//                'order_id'=>$order,
//                'product_id'=>$value['product_id'],
//                'count'=>$value['count'],
//                'amount'=>$value['ammount'],
//            ]);
        }
        unset($_SESSION['cart']);
        return redirect()->back();
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
        $pr=IncomingProduct::where('id',$id)->first();
        if ($pr->count){
        $total_price=($pr->count)*($request->price);}
        else{
            $total_price=($pr->miqdori)*($request->price);
        }
        $pr->update(
            [
                'total_price'=>$total_price,
                'price'=>$request->price,
            ]
        );
        return redirect()->back();
    }


    public function destroy($id)
    {
        //
    }
}
