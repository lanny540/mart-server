<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'specification' => $this->specification,
            'price' => '￥ ' . $this->price / 100,
            'stock' => $this->stock,
            'online' => $this->online,
        ];
    }
}
