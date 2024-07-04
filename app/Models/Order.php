<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['user_id','status','lat','lang','address_name','supplier_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public $st=[-1=>'bekor qilindi',0=>'yangi',1=>'yig`ilmoqda',2=>'yolda',3=>'bajarildi'];
}
