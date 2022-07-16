<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\Event;
use App\Models\Visitor;
use App\Models\EventReviews;
use Validator;
use Auth;
use App\Http\Resources\V1\User\EventsResource;
use App\Http\Resources\V1\Cader\RatingResource;

class EventsApiController extends Controller
{
    use api_return;

    public function index(){

        $now_date = date('Y-m-d',strtotime('now'));
        $events = Event::with('available_gates','eventBrands')->where('end_date','>=',$now_date)->orderBy('created_at','desc')->paginate(10);
        $new = EventsResource::collection($events);
        return $this->returnPaginationData($new,$events,"success");
    }

    public function event($event_id){

        $event = Event::where('id',$event_id)->with('available_gates','eventBrands')->first();
        $new = new EventsResource($event);
        return $this->returnData($new);
    }


    public function myevents(){

        $now_date = date('Y-m-d',strtotime('now'));
        $visitor = Visitor::where('user_id',Auth::id())->first();
        $events = $visitor->events()->paginate(10);
        $new = EventsResource::collection($events);
        return $this->returnPaginationData($new,$events,"success");
    }

    // public function search($search){
    //     global $searching, $local;
    //     $searching = $search;
    //     $local = 'name_' . app()->getLocale();
    //     $events = Event::whereIn('status',['pending','request_to_pricing'])->with(['city','specializations'])->whereHas('city',function ($query) {
    //                                 $query->where($GLOBALS['local'], 'like', '%'.$GLOBALS['searching'].'%');
    //                             })->orWhereHas('specializations',function ($query) {
    //                                 $query->where($GLOBALS['local'], 'like', '%'.$GLOBALS['searching'].'%');
    //                             })->orderBy('created_at','desc')->paginate(10);
    //     $new = EventsResource::collection($events);
    //     return $this->returnPaginationData($new,$events,"success");
    // }

    public function join(Request $request){
        $event = Event::find($request->event_id);

        $visitor = Visitor::where('user_id',$request->user_id)->first();

        $eventsVisitor = $event->eventsVisitors()->wherePivot('visitor_id',$visitor->id)->orderBy('pivot_created_at','desc')->first();

        if($eventsVisitor && $eventsVisitor->pivot->status == 1){
            return $this->returnError('401',trans('global.flash.api.already_in_event'));
        }else{
            $event->eventsVisitors()->attach([
                $visitor->id => [
                    'status' => 1,
                ],
            ]);

            return $this->returnSuccessMessage(trans('global.flash.api.success_join'));
        }
    }

    public function leave(Request $request){
        $event = Event::find($request->event_id);

        $visitor = Visitor::where('user_id',$request->user_id)->first();

        $eventsVisitor = $event->eventsVisitors()->wherePivot('visitor_id',$visitor->id)->orderBy('pivot_created_at','desc')->first();

        if($eventsVisitor){
            if($eventsVisitor->pivot->status == 1){
                $event->eventsVisitors()->wherePivot('status',1)->syncWithoutDetaching([
                    $visitor->id => [
                        'status' => 0,
                    ],
                ]);
                return $this->returnSuccessMessage(trans('global.flash.api.success_leave'));
            }else{
                return $this->returnError('401',trans('global.flash.api.error_leave'));
            }
        }else{
            return $this->returnError('401',trans('global.flash.api.not_join_before'));
        }
    }
    public function rate(Request $request){

        $rules = [
            'event_id' => 'required|integer',
            'rate' => 'required|integer',
            'comment'=>'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

     $visitor = Visitor::where('user_id',Auth::id())->first();


          if(!$visitor){

            return $this->returnError('500',trans('global.flash.api.not_rate'));
          }

          $review=EventReviews::create([
                 'event_id'=>$request->event_id,
                 'visitor_id'=>$visitor->id,
                 'rate'=>$request->rate,
                 'review'=>$request->comment,
          ]);
          if($review)
             return $this->returnSuccessMessage(trans('global.flash.api.rate'));
      }
      public function getRatings ($event_id) {

         $reviews=EventReviews::where('event_id',$event_id)->Orderby('created_at','DESC')->paginate(10);

         $new=RatingResource::collection($reviews);

         return $this->returnPaginationData($new,$reviews,"success");


      }
  }


