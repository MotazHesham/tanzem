<?php

namespace App\Http\Controllers\Api\V1\Cader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\push_notification;
use App\Traits\push_web_notification;
use App\Events\ChangeLocation;
use App\Traits\api_return;
use App\Models\User;
use App\Models\Cawader;
use App\Models\Event;
use App\Models\EventBreak;
use App\Models\BreakType;
use Carbon\Carbon;
use Auth;
use Validator;
use DateTime;
use App\Http\Resources\V1\Cader\EventsResource;
use App\Http\Resources\V1\Cader\MediaResource;
use App\Http\Resources\V1\Cader\VideoResource;

class EventApiController extends Controller
{
    use api_return;
    use push_notification;
    use push_web_notification;

    public function prev_events(){

        global $cawader_id,$now_date;
        $now_date = date('Y-m-d',strtotime('now'));

        $cawader = Cawader::where('user_id',Auth::id())->first();
        $cawader_id = $cawader->id;

        $events = Event::with('cawaders')->where('end_date','<',$now_date)
                                        ->whereHas('cawaders',function ($query){
                                            $query->where('id',$GLOBALS['cawader_id']);
                                        })->orderBy('start_date','desc')->paginate(10);

        $new = EventsResource::collection($events);
        return $this->returnPaginationData($new,$events,"success");
    }

    public function now_events(){

        $now_date = date('Y-m-d',strtotime('now'));

        global $cawader_id;
        $cawader = Cawader::where('user_id',Auth::id())->first();
        $cawader_id = $cawader->id;

        $events = Event::with('cawaders')->where('start_date','<=',$now_date)->where('end_date','>=',$now_date)
                        ->whereHas('cawaders',function ($query){
                            $query->where('id',$GLOBALS['cawader_id'])->where('cawader_event.status',1);;
                        })->orderBy('end_date','asc')->paginate(10);

        $new = EventsResource::collection($events);
        return $this->returnPaginationData($new,$events,"success");
    }

    public function current_event(){

        $now_date = date('Y-m-d',strtotime('now'));
        $now_time = date('H:i:s',strtotime('now'));

        global $cawader_id;
        $cawader = Cawader::where('user_id',Auth::id())->first();
        $cawader_id = $cawader->id;

        $event = Event::with('cawaders')->where('start_date','<=',$now_date)->where('end_date','>=',$now_date)
                        ->where('start_time','<=',$now_time)->where('end_time','>=',$now_time)
                        ->whereHas('cawaders',function ($query){
                            $query->where('id',$GLOBALS['cawader_id']);
                        })->first();
        if(!$event){
            return $this->returnError('404',trans('global.flash.api.no_event_for_now'));
        }

        return $this->event($event->id);
    }

    public function event($event_id){

        $cawader = Cawader::where('user_id',Auth::id())->first();
        $cawader_id = $cawader->id;
        $event = Event::find($event_id);
        if(!$event)
        return $this->returnError('404',('global.flash.api.no_event_for_now'));
        $event_cawaders = $event->cawaders()->wherePivot('cawader_id',$cawader_id)->first();

        if(!$event_cawaders){
            return $this->returnError('404',('global.flash.api.not_subscribed'));
        }
        //count dates from start to end
        $date = Carbon::parse(Carbon::createFromFormat(config('panel.date_format'), $event->start_date)->format('Y-m-d'));
        $date2 = Carbon::parse(Carbon::createFromFormat(config('panel.date_format'), $event->end_date)->format('Y-m-d'));
        $event_count_days = $date->diffInDays($date2);

        // calculate the actual attend each day
        $begin = new DateTime( str_replace('/','-',$event->start_date) );
        $end   = new DateTime( str_replace('/','-',$event->end_date) );
        $actual_attendance = 0;
        $out_of_zone_minutes = 0;
        $extra_hours = 0;
        for($i = $begin; $i <= $end; $i->modify('+1 day'))  {
            $raws = $event->attendance()->wherePivot('cawader_id',$cawader_id)->wherePivot('attendance1',$i->format('Y-m-d'))->get();
            $history = [
                'date' => $i->format('j M Y'),
                'attend' => null,
                'leave' => null,
                'total_minutes_out_of_zone' => null,
                'total_hours' => null,
            ];
            if($raws->count() > 0){
                $temp = 0; // to calculate extra hours
                $temp2 = 0; // to calculate out_of_zone_minutes_per_day
                $minutes_required = $event_cawaders->pivot->hours * 60;
                foreach($raws as $key => $raw) {
                    $out_of_zone_minutes += $raw->pivot->out_of_zone_minutes;
                    $temp2 += $raw->pivot->out_of_zone_minutes;
                    if($key == 0){
                        // nothing
                    }else{
                        $before = $raws[$key - 1]->pivot->attendance2;
                        $diff = Carbon::parse($before)->diffInMinutes($raw->pivot->attendance2);
                        $actual_attendance += $diff;
                        $temp += $diff;
                    }
                    if($raw->pivot->type == 'attend'){
                        $history['attend'] = Carbon::createFromFormat('H:i:s',$raw->pivot->attendance2)->format('g:i a');
                    }elseif($raw->pivot->type == 'leave'){
                        $history['leave'] = Carbon::createFromFormat('H:i:s',$raw->pivot->attendance2)->format('g:i a');
                    }
                }
                $history['total_hours'] = str_pad(floor(($temp - $temp2) / 60), 2, '0', STR_PAD_LEFT) .':'. str_pad( ($temp - $temp2) % 60, 2, '0', STR_PAD_LEFT); // str_pad() function for leading 0 to match time 00:00
                $history['total_minutes_out_of_zone'] = $temp2;
                if($temp > $minutes_required){
                    $extra_hours += ($temp - $minutes_required);
                }
            }
            $all_history[] = $history;
        }

        $name = 'name_' . app()->getLocale();

        $data = [
            'event_id' => $event->id,
            'event_name' => $event->title,
            'event_latitude' => $event->latitude,
            'event_longitude' => $event->longitude,
            'event_area' => $event->area,
            'event_city' => $event->city->$name,
            'event_address' => $event->address,
            'event_supervisor' => Cawader::find($event_cawaders->pivot->supervisor_id)->user->name ?? '',
            'event_company' => $event->company->user->name ?? '',
            'start_date' => $event->start_date,
            'end_date' => $event->end_date,
            'start_time' => Carbon::createFromFormat(config('panel.time_format'),$event->start_time)->format('H:i:s'),
            'end_time' => Carbon::createFromFormat(config('panel.time_format'),$event->end_time)->format('H:i:s'),
            'hours_requried' => $event_count_days * $event_cawaders->pivot->hours,
            'out_of_zone_minutes' => $out_of_zone_minutes,
            'actual_attendance' => str_pad(floor(($actual_attendance - $out_of_zone_minutes) / 60), 2, '0', STR_PAD_LEFT) .':'. str_pad( ($actual_attendance - $out_of_zone_minutes) % 60, 2, '0', STR_PAD_LEFT),
            'extra_hours' => str_pad(floor($extra_hours / 60), 2, '0', STR_PAD_LEFT) .':'. str_pad($extra_hours % 60, 2, '0', STR_PAD_LEFT), // str_pad() function for leading 0 to match time 00:00
            'history' => $all_history,
            'photos'          => MediaResource::collection($event->getMedia('photos')),
            'videos'=> VideoResource::collection($event->getMedia('videos')),
            'ratings_avg'=>$event->reviews()->avg('rate'),

        ];

        return $this->returnData($data);
    }

    public function break_request(Request $request){
        $rules = [
            'event_id' => 'required|integer',
            'break_id' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }
        $event = Event::find($request->event_id);
        if(!$event){
            return $this->returnError('404',trans('global.flash.api.not_found'));
        }

        $cawader = Cawader::where('user_id',Auth::id())->first();

        $break = BreakType::find($request->break_id);

        $event_break = EventBreak::create([
            'event_id' => $request->event_id,
            'cawader_id' => $cawader->id,
            'break' => $break->name,
            'time' => $break->time,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        $alert_text = 'طلب إذن  من '.$cawader->user->name;
        $alert_link = $event->id;
        $data = [
            'user' => $cawader->user->name ?? '',
            'event' => $request->event_id ?? '',
            'user_id' => $cawader->user_id ?? '',
            'break'=>$break->name ?? '',
            'time' => $break->time ?? '',
        ];

        $this->send_web_notification( $alert_text , $alert_link ,'permission',$data);

        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }

    public function break_cancel(Request $request){

        $rules = [
            'event_id' => 'required|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }
        $cawader = Cawader::where('user_id',Auth::id())->first();

        $event_break = EventBreak::where('cawader_id',$cawader->id)->where('event_id',$request->event_id)->orderBy('created_at','desc')->first();
        $event_break->status = 'cancel';
        $event_break->save();

        return $this->returnSuccessMessage(trans('global.flash.api.canceled'));
    }

    public function attend(Request $request){
        $rules = [
            'event_id' => 'required|integer',
            'latitude' => 'required',
            'longitude' => 'required',
            'type' => 'in:attend,leave,stream',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $event = Event::find($request->event_id);
        if(!$event){
            return $this->returnError('404',trans('global.flash.api.not_found'));
        }

        $distance = $this->twopoints_on_earth($event->latitude,$event->longitude,
                                            $request->latitude,$request->longitude);

        $cawader = Cawader::where('user_id',Auth::id())->first();

        $alert = 0;
        $insert = 0;
        $now_time = date('H:i:s',time());
        $now_date = date('Y-m-d',time());


        // after cader leave the event stop get stream from apis
        $leave_before = $event->attendance()->wherePivot('cawader_id',$cawader->id)->where('type','leave')->wherePivot('attendance1',$now_date)->first();
        if($leave_before){
            return $this->returnError('401',trans('global.flash.api.attend_before'));
        }

        if($request->type != 'stream'){

            if($request->type == 'attend'){
                $attend_before = $event->attendance()->wherePivot('cawader_id',$cawader->id)->where('type','attend')->wherePivot('attendance1',$now_date)->first();
                if($attend_before){
                    return $this->returnError('401',trans('global.flash.api.attend_before'));
                }
                if($distance > $event->area){
                    $distance_long = $distance - $event->area;
                    return $this->returnError('401',(
                                                    trans('global.flash.api.must_attend_in_area')
                                                    . round($distance_long,2) .
                                                    trans('global.flash.api.meter_from_area')
                                                    )
                                            );
                }
            }
            $event->attendance()->attach([
                $cawader->id => [
                    'out_of_zone' => $distance > $event->area ? 1 : 0,
                    'type' => $request->type,
                    'attendance1' => $now_date,
                    'attendance2' => $now_time,
                    'longitude' => $request->longitude,
                    'latitude' => $request->latitude,
                    'distance' => $distance,
                ],
            ]);
        }else{

            // check existance of cawader .....
            //  before  => in  out in out
            //  now     => out in  in out
            //  result  => 1   1   0  0
            // -------------------------------

            //              before(in)             now(out)                       before(out)              now(in)
            $insert = (!$cawader->out_of_zone && $distance > $event->area) || ($cawader->out_of_zone && $distance < $event->area);

            //          before(in)             now(out)
            $alert = !$cawader->out_of_zone && $distance > $event->area;

            if($insert){
                //       before(out)              now(in)
                if($cawader->out_of_zone && $distance < $event->area){
                    $last_check = $event->attendance()->wherePivot('type','stream')->wherePivot('out_of_zone',1)->where('attendance1',$now_date)->orderBy('created_at','desc')->get()->first();
                    $diff = Carbon::parse($now_time)->diffInMinutes($last_check->pivot->attendance2);
                    $this->send_notification('الرجوع إلي نطاق الفعالية' , 'تم الرجوع لنطاق الفعالية' , '' , '' , 'map_border' , $cawader->user_id, false);
                }

                $event->attendance()->attach([
                    $cawader->id => [
                        'out_of_zone' => $distance > $event->area ? 1 : 0,
                        'type' => $request->type,
                        'attendance1' => $now_date,
                        'attendance2' => $now_time,
                        'out_of_zone_minutes' => $diff ?? null,
                        'longitude' => $request->longitude,
                        'latitude' => $request->latitude,
                        'distance' => $distance,
                    ],
                ]);

                if($alert){
                    $this->send_notification('خارج نطاق الفعالية' , 'برجاء الرجوع لمنطفة الفعالية' , '' , '' , 'map_border' , $cawader->user_id, false);
                }
            }
        }

        $cawader->latitude = $request->latitude;
        $cawader->longitude = $request->longitude;
        $cawader->out_of_zone = $distance > $event->area ? 1 : 0;
        $cawader->save();

        $name = Auth::user()->name;

        $data = [
            'user_id' => Auth::id(),
            'name' => $name,
            'event_id' => $request->event_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'alert_out_of_zone' => $alert ? 1 : 0,
            'refresh' => $insert ? 1 : 0,
        ];
        event(new ChangeLocation($data));

        return $this->returnSuccessMessage(trans('global.flash.api.attend'));
    }

    public function changeStatus(Request $request){
        $rules = [
            'event_id' => 'required|integer',
            'status' => 'required|integer',  //0=>refused --- 1=>accept -- 2=>pending
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }
        $event = Event::find($request->event_id);
        if(!$event){
            return $this->returnError('404',trans('global.flash.api.not_found'));
        }
        $cawader = Cawader::where('user_id',Auth::id())->first();

        $cawader = $event->cawaders()->where('event_id',$request->event_id)->where('cawader_id', $cawader->id)->first();

        $cawader->pivot->status = $request->status;

        $cawader->pivot->save();

        return $this->returnSuccessMessage(trans('global.flash.api.success'));

    }

    // calculate distance between twopoints_on_earth
    function twopoints_on_earth($latitudeFrom, $longitudeFrom, $latitudeTo,  $longitudeTo)
    {
        $long1 = deg2rad($longitudeFrom);
        $long2 = deg2rad($longitudeTo);
        $lat1 = deg2rad($latitudeFrom);
        $lat2 = deg2rad($latitudeTo);

        //Haversine Formula
        $dlong = $long2 - $long1;
        $dlati = $lat2 - $lat1;

        $val = pow(sin($dlati/2),2)+cos($lat1)*cos($lat2)*pow(sin($dlong/2),2);

        $res = 2 * asin(sqrt($val));

        $radius = 3958.756;

        //transform to meter
        $transform = (1.609344 * 1000);
        return ($res*$radius) * $transform;
    }
}
