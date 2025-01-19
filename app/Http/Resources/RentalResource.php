<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentalResource extends JsonResource
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
            'start' => date("d F, Y", strtotime($this->start)),
            'end' => date("d F, Y", strtotime($this->end)),
            'cost' => $this->cost,
            'formated_cost' => 'Rp ' . number_format($this->cost, 0, ',', '.'),
            'status' => $this->status,
            'car' => $this->car,
            'tenant' => $this->createdBy
        ];
    }
}
