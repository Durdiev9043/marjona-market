<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
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
        $orderproducts=OrderProduct::all();
        return view('admin.home',['orders'=>$orders,'orderproducts'=>$orderproducts]);
    }
}
