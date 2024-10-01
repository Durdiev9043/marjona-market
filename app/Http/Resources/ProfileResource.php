<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin User */
class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'surename' => $this->surename,
            'phone'    => $this->phone,
            'balans'   => $this->balans,
            'gender'   => $this->gender,
            'birthday' => $this->birthday,
        ];
    }
}
