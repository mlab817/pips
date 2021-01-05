<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResettlementActionPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'y2017'                 => (float) $this->y2017,
            'y2018'                 => (float) $this->y2018,
            'y2019'                 => (float) $this->y2019,
            'y2020'                 => (float) $this->y2020,
            'y2021'                 => (float) $this->y2021,
            'y2022'                 => (float) $this->y2022,
            'y2023'                 => (float) $this->y2023,
            'y2024'                 => (float) $this->y2024,
            'y2025'                 => (float) $this->y2025,
            'affected_households'   => $this->affected_households,
        ];
    }
}