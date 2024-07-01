<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderCancel()
    {
        $orders=Order::where('status',-1)->get();
        $orderproducts=OrderProduct::all();
        return view('admin.order.index',['orders'=>$orders,'orderproducts'=>$orderproducts]);
    }
    public function orderProgress()
    {
        $orders=Order::where('status',1)->Orwhere('status',2)->get();
        $orderproducts=OrderProduct::all();
        return view('admin.order.index',['orders'=>$orders,'orderproducts'=>$orderproducts]);
    }
}
