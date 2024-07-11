<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class CourierController extends BaseController
{
    public function getOrder(){
        $orders=Order::where('status',1)->Where('supplier_id',NULL)->get();
        return $this->sendSuccess($orders,'Buyurtmalar Royxati');
    }
    public function takeOrder(Request $request, $id){
//        $test=count(Order::where('supplier_id',$id)->where('status','!=',3)->get());
//        if ($test){
//            return Order::where('supplier_id',$id)->get();
//
//        }else{
//            $orders=Order::find($request->order_id);
//            $orders->supplier_id = $id;
//            $orders->save();
//            return $this->sendSuccess($orders,'Siz ning yangi qabul qilgan buyurutmangiz');
//        }
        $orders = Order::find($request->order_id);

        if (!$orders) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Check if there are any existing orders for the supplier with status != 3
//        $existingOrders = Order::where('supplier_id', $id)->where('status', '!=', 3)->get();

//        if ($existingOrders->count() > 0) {
//            return $existingOrders;
//        } else {
            // Assign supplier_id to the order and save it
        if ($orders->supplier_id == NULL) {
            $orders->supplier_id = $id;
            $orders->save();
            return $this->sendSuccess($orders, 'Sizning yangi qabul qilgan buyurutmangiz');
        }else{
            return response()->json(['error' => 'Order not found'], 404);
        }

//        }
    }
    public function historyOrder($id)
    {
        $orders=Order::where('supplier_id',$id)->get();
        return $this->sendSuccess($orders,'sizning barcha buyurutmalaringiz');
    }
    public function myOrder($id)
    {
        $orders=Order::where('supplier_id',$id)->where('status',[1,2])->get();
        return $this->sendSuccess($orders,'sizning jarayondagi buyurutmalaringiz');
    }

}
