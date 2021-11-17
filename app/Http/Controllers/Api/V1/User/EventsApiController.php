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
        $events = Event::with('available_gates')->orderBy('created_at','desc')->paginate(10);
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

        $eventsVisitor = $event->eventsVisitors()->wherePivot('visitor_id',$visitor->id)->wherePivot('status',1)->first();

        if($eventsVisitor){
            return $this->returnError('401',('Cant Join, ALready In'));
        }else{ 
            $event->eventsVisitors()->attach([
                $visitor->id => [  
                    'status' => 1, 
                ],
            ]);

            return $this->returnSuccessMessage(__('Success Scan Event'));
        } 
    }

    public function leave(Request $request){ 
        $event = Event::find($request->event_id); 

        $visitor = Visitor::where('user_id',$request->user_id)->first();

        $eventsVisitor = $event->eventsVisitors()->wherePivot('visitor_id',$visitor->id)->wherePivot('status',1)->first();

        if($eventsVisitor){
            if($eventsVisitor->pivot->status == 1){ 
                $event->eventsVisitors()->wherePivot('status',1)->syncWithoutDetaching([
                    $visitor->id => [  
                        'status' => 0, 
                    ],
                ]);
                return $this->returnSuccessMessage(__('Success Leave Event'));
            }else{
                return $this->returnError('401',('Already Left ??'));
            }
        }else{  
            return $this->returnSuccessMessage(__('Not Found'));
        } 
    }
    public function response(Request $request){
        $rules = [
            'event_id' => 'required|integer',
            'type' => 'in:accepted,refused', 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $event = Event::find($request->event_id); 
        $cader = Cader::where('user_id',Auth::id())->first();
        $event->caders()->syncWithoutDetaching([
            $cader->id => [ 
                'status' => $request->response, 
            ],
        ]);
        return $this->returnSuccessMessage(__('Response Sent Succeessfully'));
    }
    
}
