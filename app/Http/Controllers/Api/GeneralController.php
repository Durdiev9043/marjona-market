<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function category(){
        $cat=Category::all();
        return $cat;
    }
    public function productlist(){
        $product=Product::all();
        return $product;
    }
    public function productfilter($id){
        $product=Product::where('category_id',$id)->get();
        return $product;
    }
//'user_id','status','lat','lang','address_name':'product_id','count','miqdor','total_price','order_id'
    public function orderstory(Request $request,$id)
    {$user=User::where('id',$id)->first();
        dd($request->all());
     /*   $p_id=Order::create([
            'user_id'=>$user->id,
            'status'=>0,
            'lat'=>$request->lat,
            'lang'=>$request->lang,
            'address_name'=>$request->address_name,
        ])->id;
        $products=json_decode($request->products);
        foreach ($products as $product){
            OrderProduct::create([
                'product_id'=>$product['product_id'],
                'count'=>$product['count'],
                'miqdor'=>$product['miqdor'],
                'total_price'=>$product['total_price'],
                'order_id'=>$p_id,
            ]);
        }
        return 'buyurtmalar qabul qilindi';*/
//        return $user_id->id;
    }
    public function orderhistory($id)
//'user_id','status','lat','lang','address_name':'product_id','count','miqdor','total_price','order_id'
    {
        $user=User::where('id',$id)->first();
        $today=DB::table('order_products')
            ->select('orders.id',
                'orders.user_id',
                'orders.status',
                'order_products.product_id',
                'order_products.miqdor',
                'order_products.total_price',
                'order_products.order_id as po_id',
                )
            ->join('orders', 'orders.id', '=', 'order_products.order_id')
            ->where('user_id',$user->id)->get();
        return $today;
    }
}
