<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{

    public function search(Request $request)
    {
        $cats=Category::whereNull('cat_id')->get();
        $hashs=Category::whereNotNull('cat_id')->get();
        $products=Product::where('code',$request->code)->paginate(50);
        return view('admin.product.index',['cats'=>$cats,'products'=>$products,'hashs'=>$hashs]);
    }

    public function productLess()
    {
        $cats=Category::whereNull('cat_id')->get();
        $hashs=Category::whereNotNull('cat_id')->get();
        $products=Product::where('count', '<' , 5)->paginate(50);
        return view('admin.product.index',['cats'=>$cats,'products'=>$products,'hashs'=>$hashs]);
    }
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
        $orders=Order::where('status','>',-1)->where('status','<',1)->get();
        $users=User::all();
        $orderproducts=OrderProduct::whereNull('cancel')->whereNull('comment')->get();
        return view('admin.order.new',['orders'=>$orders,'orderproducts'=>$orderproducts,'users'=>$users]);
    }
    public function orderView(Order $order)
    {
        $orderproducts=OrderProduct::where('order_id',$order->id)->get();
        return view('admin.order.view',['order'=>$order,'orderproducts'=>$orderproducts]);
    }
    public function orderDone()
    {
        $orders=Order::where('status',3)->get();
        $users=User::all();
        $orderproducts=OrderProduct::whereNull('cancel')->get();
        return view('admin.order.done',['orders'=>$orders,'orderproducts'=>$orderproducts,'users'=>$users]);
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
    public function orderProductCancel(Request $request,$id)
    {
OrderProduct::where('id',$id)->update(['comment'=>$request->comment]);
return redirect()->back()->with('success','Mahsulot buyurtmadan bekor qilindi');
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
        $product=Product::where('code',$request->code)->Orwhere('id',$request->id)->first();

        return $product;
    }
    public function region(Request $request){
//        $data=Category::where('cat_id',$request->category_id)->whereNotNull('cat_id')->get();
        $data=DB::table('categories')->select('*')->where('cat_id',$request->cat)->whereNotNull('cat_id')->get();
        return $data;
    }

    public function nameSearch(Request $request){
        $cats=Category::whereNull('cat_id')->get();
        $hashs=Category::whereNotNull('cat_id')->get();
        $products=Product::where('name','like','%'.$request->name.'%')->paginate(50);
        $name=$request->name;
        return view('admin.product.index',['cats'=>$cats,'products'=>$products,'name'=>$name,'hashs'=>$hashs]);
    }
    public function idSearch(Request $request){
        $cats=Category::whereNull('cat_id')->get();
        $hashs=Category::whereNotNull('cat_id')->get();

        $products=Product::where('id','like','%'.$request->id.'%')->paginate(50);
        $id=$request->id;
        return view('admin.product.index',['cats'=>$cats,'products'=>$products,'id'=>$id,'hashs'=>$hashs]);
    }
    public function idCat(Request $request){

        $cats=Category::whereNull('cat_id')->get();
        $hashs=Category::whereNotNull('cat_id')->get();
        $products=Product::where('category_id',$request->cat_id)->orWhere('hash_id',$request->hash_id)->paginate(50);
        $cat=Category::where('id',$request->cat_id)->first();
        return view('admin.product.index',['cats'=>$cats,'products'=>$products,'cat'=>$cat,'hashs'=>$hashs]);
    }
}
