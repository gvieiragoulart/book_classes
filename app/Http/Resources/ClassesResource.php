<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id'         => $this->id,
            'name'      => $this->name,
            'description' => $this->description,
            'start_date' => Carbon::parse($this->start_date)->format('d/m/Y'),
            'end_date' => Carbon::parse($this->end_date)->format('d/m/Y'),
            'capacity' => $this->capacity,
            'bookings' => empty($this->bookings) ? [] : BookingResource::collection($this->bookings),
        ];
    }
}
