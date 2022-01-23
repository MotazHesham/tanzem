<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\Event; 
use App\Models\Visitor; 
use Validator;
use Auth;
use App\Http\Resources\V1\User\EventsResource;

class EventsApiController extends Controller
{
    use api_return;

    public function index(){
        $events = Event::with('available_gates','eventBrands')->orderBy('created_at','desc')->paginate(10);
        $new = EventsResource::collection($events);
        return $this->returnPaginationData($new,$events,"success");
    }

    public function myevents(){ 
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
            return $this->returnError('401',('لا يكمن تسجل الدخول , بالفعل بالداخل'));
        }else{ 
            $event->eventsVisitors()->attach([
                $visitor->id => [  
                    'status' => 1, 
                ],
            ]);

            return $this->returnSuccessMessage(__('تم سجيل الدخول'));
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
                return $this->returnSuccessMessage(__('تم بنجاح'));
            }else{
                return $this->returnError('401',__('تم المغادرة من قبل'));
            }
        }else{  
            return $this->returnError('401',__('لم يتم تسجيل دخوله مسبفا'));
        } 
    } 
    
}
