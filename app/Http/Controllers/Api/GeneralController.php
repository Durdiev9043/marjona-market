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

class GeneralController extends BaseController
{
    public function category(){
        $cat=Category::all();
        return $this->sendSuccess($cat,'Dokondagi barcha Mahsulotlar Toifalari');
    }
    public function productlist(){
        $products=Product::all();
        $tt=[];
//        $data=[];
        foreach ($products as $product){
//            'category_id','name','more','price','img','img2','img3','img4','img5','count','status','miqdori','type','code'
            $data=[];
            $data['id']=$product->id;
            $data['category_id']=$product->category_id;
            $data['name']=$product->name;
            $data['more']=$product->more;
            $data['price']=$product->price;
            $data['count']=$product->count;
            $data['miqdori']=$product->miqdori;
            $data['code']=$product->code;
            $data['type']=$product->type;
            if ($product->img) {
                $data['img'][] = $product->img;
            }
            if ($product->img2) {
                $data['img'][] = $product->img2;
            }
            if ($product->img3) {
                $data['img'][] = $product->img3;
            }
            if ($product->img4) {
                $data['img'][] = $product->img4;
            }
            if ($product->img5) {
                $data['img'][] = $product->img5;
            }
            $tt[]=$data;
        }
       return $this->sendSuccess($tt,'Dokondagi barcha Mahsulotlar');
    }
    public function productfilter($id){
        $products=Product::where('category_id',$id)->get();
        $tt=[];
//        $data=[];
        foreach ($products as $product) {
//            'category_id','name','more','price','img','img2','img3','img4','img5','count','status','miqdori','type','code'
            $data = [];
            $data['id'] = $product->id;
            $data['category_id'] = $product->category_id;
            $data['name'] = $product->name;
            $data['more'] = $product->more;
            $data['price'] = $product->price;
            $data['count'] = $product->count;
            $data['miqdori'] = $product->miqdori;
            $data['code'] = $product->code;
            $data['type'] = $product->type;
            if ($product->img) {
                $data['img'][] = $product->img;
            }
            if ($product->img2) {
                $data['img'][] = $product->img2;
            }
            if ($product->img3) {
                $data['img'][] = $product->img3;
            }
            if ($product->img4) {
                $data['img'][] = $product->img4;
            }
            if ($product->img5) {
                $data['img'][] = $product->img5;
            }
            $tt[] = $data;
        }
        return $this->sendSuccess($tt,'chotki');
    }
    public function homelist()
    {
        $cat=Category::all();
        $product=Product::all();
        $data=[];

        foreach ($cat as $item){
            $tt=[];
            $tt['cat_id']=$item->id;
            $tt['name']=$item->name;
            $products=Product::where('category_id',$item->id)->get();
            foreach ($products as $product) {
//            'category_id','name','more','price','img','img2','img3','img4','img5','count','status','miqdori','type','code'
                $pp = [];
                $pp['id'] = $product->id;
                $pp['category_id'] = $product->category_id;
                $pp['name'] = $product->name;
                $pp['more'] = $product->more;
                $pp['price'] = $product->price;
                $pp['count'] = $product->count;
                $pp['miqdori'] = $product->miqdori;
                $pp['code'] = $product->code;
                $pp['type'] = $product->type;
                if ($product->img) {
                    $pp['img'][] = $product->img;
                }
                if ($product->img2) {
                    $pp['img'][] = $product->img2;
                }
                if ($product->img3) {
                    $pp['img'][] = $product->img3;
                }
                if ($product->img4) {
                    $pp['img'][] = $product->img4;
                }
                if ($product->img5) {
                    $pp['img'][] = $product->img5;
                }

                $tt['products'][] = $pp;
            }
            $data[]=$tt;
        }

        return $this->sendSuccess($data,'home page uchun api');
    }
//'user_id','status','lat','lang','address_name':'product_id','count','miqdor','total_price','order_id'
    public function orderstory(Request $request,$id)
    {$user=User::where('id',$id)->first();
        $jsonData = $request->json()->all();
//        dd($jsonData['lat']);
//        $rrr= json_decode($request->json(), true);
       $p_id=Order::create([
            'user_id'=>$user->id,
            'status'=>0,
            'lat'=>$jsonData['lat'],
            'lang'=>$jsonData['lang'],
            'address_name'=>$jsonData['address_name'],
        ])->id;
//        $products=json_decode($request->products);
        foreach ($jsonData['products'] as $product){
            OrderProduct::create([
                'product_id'=>$product['product_id'],
                'count'=>$product['count'],
                'miqdor'=>$product['miqdor'],
                'total_price'=>$product['total_price'],
                'order_id'=>$p_id,
            ]);
        }
        $msg='Buyurtma saqlandi';
       return $this->sendSuccess('created',$msg);
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
        return $this->sendSuccess($today,'Buyurtmalar tarixi');
    }
}
