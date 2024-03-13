<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=['category_id','name','more','price','img','count','status','miqdori','type','code'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public $aksiya=[ 0=>'Aksiyada emas',1=>'Aksiyada'];
}
