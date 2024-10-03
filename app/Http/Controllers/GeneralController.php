<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class GeneralController extends Controller
{


    public function sms()
    {
        $token='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3MjgyMTUyMzEsImlhdCI6MTcyNTYyMzIzMSwicm9sZSI6InVzZXIiLCJzaWduIjoiNTQyNzI2MTZhYzAwMTdjYzEwZDhkNjVjZTA4YjU4Yzg2OWE1ZTIzODRmMzJjODI5ZTQzNmI2OWVkNTExY2VmNyIsInN1YiI6IjY2MDYifQ.xl-FCZKtqio22Qi7RyRBVxMGEoZUimDbNvCH6iRAlbg';
        $users=User::all();
        foreach ($users as $user){
            $res = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post("http://notify.eskiz.uz/api/message/sms/send", [
                'mobile_phone' => '+998'.$user->phone,
                'message' => 'MARJONA ONLINE MARKET ILOVASIDAN YANGI VERSIYA - YANGILIKLARDAN DOIMO HABARDOR BO\'LING ILOVANI YUKLAB OLING https://play.google.com/store/apps/details?id=uz.khusinov.marjonamarket',
                'from' => '4546',
                //'callback_url' => route('receive_status')
            ]);
        }
        dd('sms yuborildi');
    }

    public function ppup()
    {
        $pp=Product::where('count','>',0)->get();
        foreach ($pp as $item){
            $item->update([
                'count'=>0
            ]);
        }
        $tt=Product::where('miqdori','>',0)->get();
        foreach ($pp as $item){
            $item->update([
                'miqdori'=>0,
            ]);
        }
        return redirect()->back();
    }

    public function pstatus()
    {
        $products=Product::where('status',1)->paginate(10);
        return view('admin.product.aksiya',['products'=>$products]);
    }
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
        $products=Product::where('count', '<' , 1)->orWhere('count',NULL)->paginate(50);
        return view('admin.product.index',['cats'=>$cats,'products'=>$products,'hashs'=>$hashs]);
    }
    public function productMinus()
    {
        $cats=Category::whereNull('cat_id')->get();
        $hashs=Category::whereNotNull('cat_id')->get();
        $products=Product::where('count', 'like' , "%-%")->get();

        return view('admin.product.minus',['cats'=>$cats,'products'=>$products,'hashs'=>$hashs]);
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
        $orders=Order::where('status','>',-1)->where('status','<',1)->orderBy('id','DESC')->get();
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
        $orders=Order::where('status',3)->orderBy('id','DESC')->paginate(10);
        $users=User::all();
        return view('admin.order.done',['orders'=>$orders, 'users' => $users]);
    }
    public function orderstatus(Request $request,$order)
    {
        $order=Order::where('id',$order)->first();
//        $orpr=OrderProduct::where('order_id',$order->id)->get();
//        foreach ($orpr as $item){
//            $p_id=$item->product_id;
//            $pp=Product::where('id',$p_id)->first();
//            $count=$pp->count - $item->count;
//            $pp->update(['count'=>$count]);
//        }
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
    public function delCard($id)
    {
        @session_start();
        unset($_SESSION['cart'][$id]);
        return redirect()->back();

    }
    public function clearCart()
    {


        @session_start();
unset($_SESSION['cart']);
return redirect()->back();
    }
    public function codeSearch(Request $request)
    {
//        $product=Product::where('code',$request->code)->Orwhere('id',$request->id)->first();
        if ($request->id !== NULL) {
            $product = Product::where('id', $request->id)->first();
        }elseif ($request->code){
            $product=Product::where('code',$request->code)->first();
        }
//        $product=$request->id;
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
        $products=Product::where('name','like','%'.$request->name.'%')->paginate(500);
        $name=$request->name;
        return view('admin.product.index',['cats'=>$cats,'products'=>$products,'name'=>$name,'hashs'=>$hashs]);
    }
    public function idSearch(Request $request){
        $cats=Category::whereNull('cat_id')->get();
        $hashs=Category::whereNotNull('cat_id')->get();

        $products=Product::where('id','like','%'.$request->id.'%')->paginate(500);
        $id=$request->id;
        return view('admin.product.index',['cats'=>$cats,'products'=>$products,'id'=>$id,'hashs'=>$hashs]);
    }
    public function idCat(Request $request){

        $cats=Category::whereNull('cat_id')->get();
        $hashs=Category::whereNotNull('cat_id')->get();
        $products=Product::where('category_id',$request->cat_id)->orWhere('hash_id',$request->hash_id)->paginate(500);
        $cat=Category::where('id',$request->cat_id)->first();
        return view('admin.product.index',['cats'=>$cats,'products'=>$products,'cat'=>$cat,'hashs'=>$hashs]);
    }
public function client()
{

    $users=$orderCounts = DB::table('users')
        ->leftJoin('orders', 'users.id', '=', 'orders.user_id')
        ->where('users.role', 2)
        ->select('users.id', 'users.phone', DB::raw('count(orders.id) as orders_count'))
        ->groupBy('users.id', 'users.phone')
        ->get();
    return view('admin.courier.view',['users'=>$users]);
}

}
