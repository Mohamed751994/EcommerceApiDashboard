<?php

namespace App\Http\Resources;

use App\Models\Product;
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
            'id' => $this->id,
            'category_name' =>  ($this->category) ? (count($this->category?->translations) > 0) ? $this->category?->translations[0]?->name:'' : '',
            'product_name' => (count($this->translations) > 0) ? $this->translations[0]?->name : '',
            'product_price' => (count($this->translations) > 0) ? $this->translations[0]?->price : '',
            'product_currency' => (count($this->translations) > 0) ? $this->translations[0]?->currency : '',
            'product_size' => (count($this->translations) > 0) ? $this->translations[0]?->size : '',
            'product_description' => (count($this->translations) > 0) ? $this->translations[0]?->description : '',
            'product_benefits' => (count($this->translations) > 0) ? $this->translations[0]?->benefits : '',
            'image' => $this->image,
            'new' => $this->new,
            'featured' => $this->featured,
            'offer' => $this->offer,
            'weight' => $this->weight . ' ' . __('text.kg'),
            'available_quantity' => $this->quantity,
            'attributes' => [
                'calories' => (!is_null($this->calories)) ? $this->calories . ' ' . __('text.calorie') : null,
                'carbohydrates' =>  (!is_null($this->carbohydrates)) ? $this->carbohydrates . ' ' . __('text.gram') : null,
                'fiber' =>  (!is_null($this->fiber)) ? $this->fiber . ' ' . __('text.gram') : null,
                'cholesterol' =>  (!is_null($this->cholesterol)) ? $this->cholesterol . ' ' . __('text.mgram') : null,
                'sugar' =>  (!is_null($this->sugar)) ? $this->sugar . ' ' . __('text.gram') : null,
                'fats' =>  (!is_null($this->fats)) ? $this->fats . ' ' . __('text.gram') : null,
            ],
            'is_wishlist' => $this->is_wishlist,

        ];
    }
}
