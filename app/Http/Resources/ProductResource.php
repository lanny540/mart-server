<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'poster' => $this->poster,
            'desc' => $this->description,
            'price' => '￥ ' . $this->price / 100,
            'brand' => $this->brand,
            'category' => $this->category->name,

            'specs' => $this->specification,
            'variations' => ProductVariationResource::collection($this->variations),
        ];
    }
}
