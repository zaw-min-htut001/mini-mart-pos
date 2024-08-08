<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->product_id,
            'name' => $this->name,
            'description' => Str::limit($this->description, 100),
            'category_name' => $this->category->name,
            'brand_name' => $this->brand->name,
            'supplier_name' => $this->supplier->name,
            'unit_price' => $this->unit_price . 'Ks',
            'current_stock' => $this->current_stock,
            'unit_of_measure' => $this->unit_of_measure,
            'image_path' =>  asset($this->getFirstMediaUrl('images')),
        ];
    }
}
