<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function orderIndex()
    {

//        $orders=DB::table('order_products')
//            ->select('orders.id',
//                'orders.user_id',
//                'orders.status',
//                'order_products.product_id',
//                'order_products.miqdor',
//                'order_products.total_price',
//                'order_products.order_id as po_id',
//            )
//            ->join('orders', 'orders.id', '=', 'order_products.order_id')
//            ->get();
        $orders=Order::all();
        $users=User::all();
        $orderproducts=OrderProduct::all();
        return view('admin.home',['orders'=>$orders,'orderproducts'=>$orderproducts,'users'=>$users]);
    }
    public function orderstatus(Request $request,$order)
    {
        $order=Order::where('id',$order)->first();
        $orpr=OrderProduct::where('order_id',$order->id)->get();
        foreach ($orpr as $item){
            $p_id=$item->product_id;
            $pp=Product::where('id',$p_id)->first();
            $count=$pp->count - $item->count;
            $pp->update(['count'=>$count]);
        }
        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->back();
    }

    public function addToCart(Request $request)
    {
        $product = $request->all();

        @session_start();

        if(isset($_SESSION["cart"]) and (!empty($_SESSION["cart"]))){
            $cart = ($_SESSION['cart']);
//            echo "cart sessiyada bo <br>";
        }else{
            $cart=[];
//            echo "cart sessiyada yoq <br>";
        }
        $cart []=array($request->all());
//        if(array_key_exists($product['product_id'],$cart)){
//            $name=DB::table('products')->where('id',$product['product_id'])->first();
//            $id=$product['product_id'];
//            $ammount=$product['count']*$name->price_size;
//            $cart[$id] += $product['count'];
//            $cart [$id]=array(
//                'product_id'=>$product['product_id'],
//                'ammount' => $ammount,
//                'count' => $product['count'],
//                'name' => $name->name,
//            ) ;
//            echo "ok <br>";
//        }else{
//            $name=DB::table('products')->where('id',$product['product_id'])->first();
//
//            $id=$product['product_id'];
//            $ammount=$product['count']*$name->price_size;
//
//            $cart[$id] = $product['count'];
//            $cart [$id]=array(
//                'ammount' => $ammount,
//                'product_id'=>$product['product_id'],
//                'count' => $product['count'],
//                'name' => $name->name,
//
//
//            ) ;
//        }

        $_SESSION['cart'] = $cart;

        return redirect()->back()->with('yardi',$cart);
    }
    public function clearCart()
    {


        @session_start();
unset($_SESSION['cart']);
return redirect()->back();
    }
    public function codeSearch(Request $request)
    {
        $product=Product::where('code',$request->code)->first();
        return $product;
    }
}
