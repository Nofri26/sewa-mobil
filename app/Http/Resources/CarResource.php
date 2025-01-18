<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'brand' => $this->brand,
            'model' => $this->model,
            'plate_number' => $this->plate_number,
            'daily_rate' => $this->daily_rate,
            'formatted_daily_rate' => 'Rp,' . number_format($this->daily_rate, 0, ',', '.'),
            'is_available' => $this->is_available,
            'created_by' => $this->createdBy->name,
        ];
    }
}
