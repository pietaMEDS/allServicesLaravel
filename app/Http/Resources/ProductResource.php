<?php

namespace App\Http\Resources;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'logo' => $this->logo,
            'description' => $this->description,
            'category' => CategoryResource::make( Categories::find( $this->category_id ) ),
            'priority' => $this->priority
        ];
    }
}
