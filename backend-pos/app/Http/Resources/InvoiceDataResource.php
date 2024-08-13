<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SaleItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cashier' => $this->user->name ,
            'invoice_id' => $this->invoice_id ,
            'date' => $this->created_at->format('d/m/Y H:i:s a'),
            'total' => $this->total_amount ,
            'sale_items' => SaleItemResource::collection($this->saleItems),
        ];
    }
}
