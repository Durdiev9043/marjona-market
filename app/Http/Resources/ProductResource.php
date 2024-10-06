<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 */
class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'price'     => $this->price,
            'new_price' => $this->new_price,
            'more'      => $this->more,
            'img'       => $this->img,
            'img2'      => $this->img2,
            'img3'      => $this->img3,
            'img4'      => $this->img4,
            'img5'      => $this->img5,
            'status'    => $this->status,
            'count'     => $this->count,
            'miqdori'   => $this->miqdori,
            'type'      => $this->type,
            'code'      => $this->code,
        ];
    }
}
