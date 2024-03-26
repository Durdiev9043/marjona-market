<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable=['name','img','cat_id'];

    public function cat()
    {
        return $this->belongsTo(Category::class);
    }
}
