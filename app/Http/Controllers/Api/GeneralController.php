<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function category(){
        $cat=Category::all();
        return $cat;
    }
    public function productlist(){
        $product=Product::all();
        return $product;
    }
    public function productfilter($id){
        $product=Product::where('category_id',$id)->get();
        return $product;
    }
}
