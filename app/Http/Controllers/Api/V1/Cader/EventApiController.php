<?php

namespace App\Http\Controllers\Api\V1\Cader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\push_notification; 
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

class EventApiController extends Controller
{ 
    use api_return; 
    use push_notification; 

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
        $event_cawaders = $event->cawaders()->wherePivot('cawader_id',$cawader_id)->first();

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
                'date' => $i->format('j F Y'), 
                'attend' => '--',
                'leave' => '--',
                'total_minutes_out_of_zone' => '--',
                'total_hours' => '--', 
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

        $fromFormat = config('panel.date_format') .' ' . config('panel.time_format');

        $data = [
            'event_id' => $event->id,
            'event_name' => $event->title,
            'start' => Carbon::createFromFormat($fromFormat, $event->start_date . ' ' . $event->start_time)->format('a g:i - j F Y'),
            'end' => Carbon::createFromFormat($fromFormat, $event->end_date . ' ' . $event->end_time)->format('a g:i - j F Y'),
            'hours_requried' => $event_count_days * $event_cawaders->pivot->hours,
            'out_of_zone_minutes' => $out_of_zone_minutes,
            'actual_attendance' => str_pad(floor(($actual_attendance - $out_of_zone_minutes) / 60), 2, '0', STR_PAD_LEFT) .':'. str_pad( ($actual_attendance - $out_of_zone_minutes) % 60, 2, '0', STR_PAD_LEFT),
            'extra_hours' => str_pad(floor($extra_hours / 60), 2, '0', STR_PAD_LEFT) .':'. str_pad($extra_hours % 60, 2, '0', STR_PAD_LEFT), // str_pad() function for leading 0 to match time 00:00
            'history' => $all_history,
        ]; 

        return response()->json($data);
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
        
        return $this->returnSuccessMessage(__('Request Sent Succeessfully'));
    }

    public function break_cancel(Request $request){

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
            return $this->returnError('404',('Not Found !!!'));
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
            return $this->returnError('401','تم تسجل الأنصراف من قبل لهذة الفعالية هذا اليوم');
        } 
        
        if($request->type != 'stream'){  

            if($request->type == 'attend'){
                $attend_before = $event->attendance()->wherePivot('cawader_id',$cawader->id)->where('type','attend')->wherePivot('attendance1',$now_date)->first();
                if($attend_before){
                    return $this->returnError('401','تم تسجل الحضور من قبل لهذة الفعالية هذا اليوم');
                }
                if($distance > $event->area){ 
                    $distance_long = $distance - $event->area;
                    return $this->returnError('401',(
                                                    ' لابد من تسجيل الحضور داخل نظاق الفعالية انت علي بعد '
                                                    . round($distance_long,2) . 
                                                    'متر من النطاق'
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
                    $this->send_notification('خارج نطاق الفعالية' , 'برجاء الرجوع لمنطفة الفعالية' , '' , '' , 'warning' , $cawader->user_id, false);
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

        return $this->returnSuccessMessage(__('Response Sent Succeessfully'));
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