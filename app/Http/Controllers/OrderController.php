<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderCancellist()
    {
        $orders = Order::query()
            ->with('products')
            ->withSum('products', 'total_price')
            ->where('status', -1)->orderBy('id', 'DESC')
            ->paginate(10);

        return view('admin.order.index', compact('orders'));
    }

    public function orderProgress()
    {
        $orders        = Order::where('status', 1)->Orwhere('status', 2)->orderBy('id', 'DESC')->get();
        $orderproducts = OrderProduct::all();

        return view('admin.order.index', ['orders' => $orders, 'orderproducts' => $orderproducts]);
    }

    public function orderCancel(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first()->update(['status' => -1]);
        $pp    = OrderProduct::where('order_id', $request->order_id)->get();
        foreach ($pp as $item) {
            $pr = Product::where('id', $item->product_id)->first();
            $cc = (int)$pr->count;
            $ct = (int)$item->count;
            $cc = $cc + $ct;
            $pr->update(['count' => $cc]);
        }

        return redirect()->back();
    }
}
