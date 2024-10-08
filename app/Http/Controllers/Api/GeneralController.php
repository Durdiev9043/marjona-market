<?php

namespace App\Http\Controllers\Api;

use App\Http\Actions\TelegramNotification;
use App\Http\Resources\ProfileResource;
use App\Models\Category;
use App\Models\LikeProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Rek;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneralController extends BaseController
{
    public function userUpdate(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Validate the request data if necessary
        $validatedData = $request->all();

        // Update the user model with validated data
        $user->fill($validatedData);

        // Save the user
        $user->save();

        return $this->sendSuccess(new ProfileResource($user), 'Foydalanuvchi ma\'lumotlar ozgartirildi');
    }

    public function pLike(Request $request, $id)
    {
        LikeProduct::create([
                                'user_id'    => $id,
                                'product_id' => $request->product_id,
                            ]);

        return $this->sendSuccess(' ', 'Mahsulot saqlandi');
    }

    public function dLike(Request $request, $id)
    {
        LikeProduct::where('user_id', $id)->where('product_id', $request->product_id)->first()->delete();
//            'user_id'=>$id,
//            'product_id'=>$request->product_id
//        );
        return $this->sendSuccess(' ', 'like ochirildi saqlandi');
    }

    public function liked($id)
    {
        $data = LikeProduct::where('user_id', $id)->get();
        $tt   = [];
        foreach ($data as $product) {
            $data = [];
//            $data[]=Product::find($product->product_id);
            $product             = Product::find($product->product_id);
            $data['id']          = $product->id;
            $data['category_id'] = $product->category_id;
            $data['name']        = $product->name;
            $data['more']        = $product->more;
            $data['price']       = $product->price;
            $data['count']       = $product->count;
            $data['miqdori']     = $product->miqdori;
            $data['code']        = $product->code;
            $data['type']        = $product->type;
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

        return $this->sendSuccess($tt, 'liked list');
    }

    public function delAccount($id)
    {
        $user = User::find($id)->delete();

        return $this->sendSuccess(' ', 'user ochirildi');
    }

    public function aksiya()
    {
        $products = Product::where('status', 1)->get();
        $tt       = [];
//        $data=[];
        foreach ($products as $product) {
//            'category_id','name','more','price','img','img2','img3','img4','img5','count','status','miqdori','type','code'
            $data                = [];
            $data['id']          = $product->id;
            $data['category_id'] = $product->category_id;
            $data['name']        = $product->name;
            $data['more']        = $product->more;
            $data['price']       = $product->price;
            $data['count']       = $product->count;
            $data['miqdori']     = $product->miqdori;
            $data['code']        = $product->code;
            $data['type']        = $product->type;
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

        return $this->sendSuccess($tt, 'qiduruv natijasi');
    }

    public function rek()
    {
        $products = Rek::all();

        return $this->sendSuccess($products, 'mahsulotlar');
    }

    public function search(Request $request)
    {
        if ($request->name !== null) {
            $products = Product::where('name', 'like', '%' . $request->name . '%')
                ->where('count', '>', 0)
                ->paginate(150);
            $tt       = [];
//        $data=[];
            foreach ($products as $product) {
//            'category_id','name','more','price','img','img2','img3','img4','img5','count','status','miqdori','type','code'
                $data                = [];
                $data['id']          = $product->id;
                $data['category_id'] = $product->category_id;
                $data['name']        = $product->name;
                $data['more']        = $product->more;
                $data['price']       = $product->price;
                $data['count']       = $product->count;
                $data['miqdori']     = $product->miqdori;
                $data['code']        = $product->code;
                $data['type']        = $product->type;
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

            return $this->sendSuccess($tt, 'qiduruv natijasi');
        } else {
            return $this->sendSuccess('mahsulot topilmadi', 'mahsulot topilmadi');
        }
    }

    public function category()
    {
        $cats = Category::whereNull('cat_id')->get();
        $data = [];
        foreach ($cats as $cat) {
            $tt          = [];
            $tt['id']    = $cat->id;
            $tt['name']  = $cat->name;
            $tt['img']   = $cat->img;
            $tt['hashs'] = DB::table('categories')
                ->select('*')
                ->where('cat_id', $cat->id)
                ->whereNotNull('cat_id')
                ->get();
            $data[]      = $tt;
        }

        return $this->sendSuccess($data, 'Dokondagi barcha Mahsulotlar Toifalari');
    }

    public function getHashesByHashId($id)
    {
        $data             = [];
        $cat_id           = Category::where('id', $id)->first()->id;
        $cat_name         = Category::where('id', $cat_id)->first()->name;
        $hashs            = Category::where('cat_id', $cat_id)->orderBy('tr')->get();
        $data['cat_id']   = $cat_id;
        $data['cat_name'] = $cat_name;
        $data['hashs']    = $hashs;

        return $this->sendSuccess($data, $cat_name . ' toifa boyicha ma\'lumotlar');
    }

    public function getProductsByHash($id)
    {
        $products = Product::where('hash_id', $id)
            ->orWhere('count', '!=', 0)
            ->orWhere('miqdori', '!=', 0)
            ->orderBy('name', 'desc')
            ->get();
        $tt       = [];
        foreach ($products as $product) {
//            'category_id','name','more','price','img','img2','img3','img4','img5','count','status','miqdori','type','code'
            $data                = [];
            $data['id']          = $product->id;
            $data['category_id'] = $product->category_id;
            $data['hash_id']     = $product->hash_id;
            $data['name']        = $product->name;
            $data['more']        = $product->more;
            $data['price']       = $product->price;
            $data['count']       = $product->count;
            $data['miqdori']     = $product->miqdori;
            $data['code']        = $product->code;
            $data['type']        = $product->type;
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

        return $this->sendSuccess($tt, ' mahsulotlar royxati');
    }

    public function productlist()
    {
        $products = Product::where('count', '!=', 0)->orWhere('miqdori', '!=', 0)->get();
        $tt       = [];
//        $data=[];
        foreach ($products as $product) {
//            'category_id','name','more','price','img','img2','img3','img4','img5','count','status','miqdori','type','code'
            $data                = [];
            $data['id']          = $product->id;
            $data['category_id'] = $product->category_id;
            $data['name']        = $product->name;
            $data['more']        = $product->more;
            $data['price']       = $product->price;
            $data['count']       = (string)$product->count;
            $data['miqdori']     = $product->miqdori;
            $data['code']        = $product->code;
            $data['type']        = $product->type;
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

        return $this->sendSuccess($tt, 'Dokondagi barcha Mahsulotlar');
    }

    public function productfilter($id)
    {
        $products = Product::where('category_id', $id)->orderBy('hash_id')->get();

        $tt = [];
        foreach ($products as $product) {
            if ($product->miqdori > 0 || $product->count > 0) {
                $data                = [];
                $data['id']          = $product->id;
                $data['category_id'] = $product->category_id;
                if ($product->hash_id) {
                    $data['hash']    = Category::where('id', $product->hash_id)->first()->name;
                    $data['hash_id'] = Category::where('id', $product->hash_id)->first()->id;
                }
                $data['name']    = $product->name;
                $data['more']    = $product->more;
                $data['price']   = $product->price;
                $data['count']   = (string)$product->count;
                $data['miqdori'] = $product->miqdori;
                $data['code']    = $product->code;
                $data['type']    = $product->type;
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
        }

        return $this->sendSuccess($tt, 'chotki');
    }

    public function homelist()
    {
        $cat  = Category::all();
        $data = [];

        foreach ($cat as $item) {
            $tt           = [];
            $tt['cat_id'] = $item->id;
            $tt['name']   = $item->name;
            $products     = Product::where('category_id', $item->id)->get();
            foreach ($products as $product) {
                $pp                = [];
                $pp['id']          = $product->id;
                $pp['category_id'] = $product->category_id;
                $pp['name']        = $product->name;
                $pp['more']        = $product->more;
                $pp['price']       = $product->price;
                $pp['count']       = $product->count;
                $pp['miqdori']     = $product->miqdori;
                $pp['code']        = $product->code;
                $pp['type']        = $product->type;
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
            $data[] = $tt;
        }

        return $this->sendSuccess($data, 'home page uchun api');
    }

    public function orderstory(Request $request, $id)
    {
        $user     = auth()->user();
        $jsonData = $request->json()->all();
        $p_id     = Order::query()
            ->create([
                         'user_id'      => $user->id,
                         'status'       => 0,
                         'lat'          => $jsonData['lat'],
                         'lang'         => $jsonData['lang'],
                         'type'         => $jsonData['type'],
                         'address_name' => $jsonData['address_name'],
                     ])->id;
        foreach ($jsonData['products'] as $product) {
            $pp    = Product::query()->where('id', $product['product_id'])->first();
            $count = $pp->count;
            $tt    = $product['count'];
            $cc    = $count - $tt;
            $pp->update([
                            'count' => $cc,
                        ]);
            OrderProduct::create([
                                     'product_id'  => $product['product_id'],
                                     'name'        => Product::where('id', $product['product_id'])->first()->name,
                                     'img'         => Product::where('id', $product['product_id'])->first()->img,
                                     'count'       => $product['count'],
                                     'miqdor'      => $product['miqdor'],
                                     'total_price' => $product['total_price'],
                                     'order_id'    => $p_id,
                                 ]);
        }
        $msg = 'Buyurtma saqlandi';

        $message = PHP_EOL . "📦 Buyurtma: #$p_id"
            . PHP_EOL . '📅 Sana : ' . now()->toDateTimeString();

        (new TelegramNotification())($message);

        return $this->sendSuccess('buyurtma yaratildi', $msg);
    }

    public function orderhistory($id)
    {
        $user = User::where('id', $id)->first();
        $data = Order::where('user_id', $user->id)->get();
        $res  = [];
        foreach ($data as $item) {
            $pr = OrderProduct::where('order_id', $item->id)->get();
            if (count($pr)) {
                $tt           = [];
                $tt['id']     = $item->id;
                $tt['status'] = $item->status;
                $tt['time']   = $item->created_at->format('d.m.Y  H:i');
                foreach ($pr as $pp) {
                    $ppt                = [];
                    $ppt['name']        = $pp->name;
                    $ppt['img']         = $pp->img;
                    $ppt['miqdor']      = $pp->miqdor;
                    $ppt['count']       = $pp->count;
                    $ppt['total_price'] = $pp->total_price;
                    $tt['products'][]   = $ppt;
                }
                $res[] = $tt;
            }
        }

        return $this->sendSuccess($res, 'Buyurtmalar tarixi');
    }

    public function productLimit()
    {
        $products = Product::where('count', '!=', 0)->orWhere('miqdori', '!=', 0)->inRandomOrder()->limit(18)->get();
        $tt       = [];
        foreach ($products as $product) {
//            'category_id','name','more','price','img','img2','img3','img4','img5','count','status','miqdori','type','code'
            $data                = [];
            $data['id']          = $product->id;
            $data['category_id'] = $product->category_id;
            $data['hash_id']     = $product->hash_id;
            $data['name']        = $product->name;
            $data['more']        = $product->more;
            $data['price']       = $product->price;
            $data['count']       = $product->count;
            $data['miqdori']     = $product->miqdori;
            $data['code']        = $product->code;
            $data['type']        = $product->type;
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

        return $this->sendSuccess($tt, ' mahsulotlar royxati');
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

        return $this->sendSuccess($order, ' Buyurtma bekor qilindi');
    }

}
