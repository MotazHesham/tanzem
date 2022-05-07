<?php

namespace App\Http\Resources\V1\Cader;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $video= $this;

      if($video){
        $video = $video ? asset($video->getUrl()) : null;
        $video = str_replace('public/public','public',$video);
     }
   else
        $video='';
       return [

         'video'=>$video,

       ];
   }
}
