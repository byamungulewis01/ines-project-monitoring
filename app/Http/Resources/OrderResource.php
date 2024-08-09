<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order' => $this->index,
            'customer_name' => $this->customer->name,
            'customer_phone' => $this->customer->phone,
            'amount' => number_format($this->products->sum('amount')),
            'status' => $this->status,
            'created_at' => $this->created_at->format('d M, Y'),
            'show_route' => route('orders.show',$this->id),
            'edit_route' => route('orders.edit',$this->id),
        ];
    }
}
