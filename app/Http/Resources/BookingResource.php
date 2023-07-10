<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'id'         => $this->id ?? $this['id'],
            'class_id'  => $this->class_id ?? $this['class_id'],
            'name'      => $this->name ?? $this['name'],
            'date' => empty($this->date) ? Carbon::parse($this['date'])->format('d/m/Y') : Carbon::parse($this->date)->format('d/m/Y'),
        ];
    }
}
