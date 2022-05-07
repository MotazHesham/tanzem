<?php

namespace App\Http\Resources\V1\Cader;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
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
            'rate'  => $this->rate,
            'comment'=> $this->review,
            'visitor_id'=>$this->visitor_id,
            'event_id'=>$this->event_id,
            'visitor_name'=>$this->visitor->user->name,
        ];
    }
}
