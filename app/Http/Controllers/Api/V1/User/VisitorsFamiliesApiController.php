<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\VisitorsFamily; 
use App\Models\Visitor; 
use Validator;
use Auth;
use App\Http\Resources\V1\User\VisitorFamilyResource;

class VisitorsFamiliesApiController extends Controller
{

    use api_return;

    public function index(){
        $visitor = Visitor::where('user_id',Auth::id())->first();
        $vistor_families = VisitorsFamily::where('visitor_id',$visitor->id)->orderBy('created_at')->get();
        return $this->returnData(VisitorFamilyResource::collection($vistor_families));
    }

    public function store(Request $request){
        
        $rules = [ 
            'name' => 'required|string',
            'relation' => 'required|string',
            'phone' => 'required|string',
            'identity' => 'required|string',
            'gender' => 'in:male,female',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $visitor = Visitor::where('user_id',Auth::id())->first();
        
        VisitorsFamily::create([
            'visitor_id' => $visitor->id,
            'name' => $request->name,
            'gender' => $request->gender,
            'relation' => $request->relation,
            'phone' => $request->phone,
            'identity' => $request->identity,
        ]);
        

        return $this->returnSuccessMessage(trans('global.flash.success'));
    } 

    public function delete($id){
        $visitor = Visitor::where('user_id',Auth::id())->first();
        
        VisitorsFamily::find($id)->delete();

        return $this->returnSuccessMessage(trans('global.flash.deleted')); 
    }
}
