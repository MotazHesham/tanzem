<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Http\Resources\V1\Cader\MediaResource;
use App\Http\Resources\V1\Cader\VideoResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $name = 'name_' . app()->getLocale();
        return [
                'event_id' => $this->id,
                'event_name' => $this->title,
                'event_latitude' => $this->latitude,
                'event_longitude' => $this->longitude,
                'event_area' => $this->area,
                'event_city' => $this->city->$name,
                'event_address' => $this->address,
                'event_company' => $this->company->user->name ?? '',
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'start_time' => Carbon::createFromFormat(config('panel.time_format'),$this->start_time)->format('H:i:s'),
                'end_time' => Carbon::createFromFormat(config('panel.time_format'),$this->end_time)->format('H:i:s'),
                'photos'          => MediaResource::collection($this->getMedia('photos')),
                'videos'=> VideoResource::collection($this->getMedia('videos')),
                'ratings_avg'=>$this->reviews()->avg('rate'),

            ];
    }
}
