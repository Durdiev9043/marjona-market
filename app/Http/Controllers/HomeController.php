<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $today=DB::table('orders')->where('status',2)->whereDate('created_at', Carbon::today())->get()->count();
        $today_cancel=DB::table('orders')->where('status',-1)->whereDate('created_at', Carbon::today())->count();
        $today_sum=DB::table('orders')
            ->select('orders.id','orders.status','order_products.created_at','order_products.total_price','order_products.order_id')
            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->where('orders.status',2)
            ->whereDate('orders.created_at', Carbon::today())->sum('total_price');
        $today_cancel_sum=DB::table('orders')
            ->select('orders.id','orders.status','order_products.created_at','order_products.total_price','order_products.order_id')
            ->join('order_products', 'orders.id', '=', 'order_products.order_id')
            ->where('orders.status',-1)
            ->whereDate('orders.created_at', Carbon::today())->sum('total_price');
        $today_price=DB::table('orders')->where('status',-1)->whereDate('created_at', Carbon::today())->get();
        $yesterday=DB::table('orders')->where('status',2)->whereDate('created_at', Carbon::yesterday())->count();
        $yesterday_cancel=DB::table('orders')->where('status',-1)->whereDate('created_at', Carbon::yesterday())->count();
        return view('admin.home', [
            'today'=>$today,
            'yesterday'=>$yesterday,
            'yesterday_cancel'=>$yesterday_cancel,
            'today_cancel'=>$today_cancel,
            'today_sum'=>$today_sum,
            'today_cancel_sum'=>$today_cancel_sum
        ]);
    }
}
