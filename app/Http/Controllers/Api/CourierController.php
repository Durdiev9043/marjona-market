<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class CourierController extends BaseController
{
    public function getOrder(){
        $orders=Order::where('status',1)->get();
        return $this->sendSuccess($orders,'Buyurtmalar Royxati');
    }
}
