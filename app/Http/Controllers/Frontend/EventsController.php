<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Setting;
use App\Models\Visitor;
use App\Models\EventReviews;
use Alert;
use Auth;

class EventsController extends Controller
{
    public function events(Request $request){
        $setting = Setting::first();
        $events = Event::orderBy('created_at','desc');
        
        $specialization_id = null;
        $city_id = null;
        $title = null;

        if($request->has('specialization_id') && $request->specialization_id != null){
            global $specialization_id;
            $specialization_id = $request->specialization_id;
            $events = $events->whereHas('specializations',function ($query) {
                $query->where('id', 'like', $GLOBALS['specialization_id']);
            });
        }

        if($request->has('city_id') && $request->city_id != null){ 
            $city_id = $request->city_id;
            $events = $events->where('city_id',$city_id);
        }

        if($request->has('title') && $request->title != null){ 
            $title = $request->title;
            $events = $events->where('title','like', '%' . $title . '%');
        }

        $events = $events->paginate(12);
        $events->appends($request->all());
        
        return view('frontend.events',compact('setting','events','specialization_id','city_id'));
    }

    public function event($id){
        $event = Event::with('reviews.user')->findOrFail($id); 
        return view('frontend.event',compact('event'));
    }

    public function rate(Request $request){

      if($request->star)
           $rate=$request->star;
     else
            $rate=0; 

     $user=Visitor::where('user_id',Auth::id())->first();
        
        if(!$user){
            Alert::error('قم بتسجيل الدخول كزائر للتقييم ', 'خطأ  ');
            return redirect()->back(); 
        }

        $review=EventReviews::create([
               'event_id'=>$request->event_id,
               'visitor_id'=>$user->id,
               'rate'=>$rate,
               'review'=>$request->comment,
        ]);
           Alert::success('تم بنجاح', 'تم إضافة تقييمك بنجاح ');
           return redirect()->back();
    }
}
