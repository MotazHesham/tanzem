<?php

namespace App\Http\Requests;

use App\Models\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Auth;

class UpdateEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_edit') || Auth::user()->user_type == 'companiesAndInstitution'|| Auth::user()->user_type == 'client' || Auth::user()->user_type == 'governmental_entity'; 
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'start_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'end_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'city_id' => [
                'required',
                'integer',
            ],
            'address' => [
                'string',
                'required',
            ],
            'latitude' => [
                'required',
            ],
            'longitude' => [
                'required',
            ],
            'photo' => [
                'required',
            ],
            'company_id' => [
                'required',
                'integer',
            ],
            'client_id' => [
                'required',
                'integer',
            ],
            'government_id' => [
                'required',
                'integer',
            ],
            'available_gates.*' => [
                'integer',
            ],
            'available_gates' => [
                'required',
                'array',
            ],
            'specializations.*' => [
                'integer',
            ],
            'specializations' => [
                'required',
                'array',
            ],
            'cawaders.*.hours' => [ 
                'required',
            ],
            'cawaders.*.amount' => [ 
                'required',
            ],
            'cawaders' => [
                'array',
                'required',
            ],
            'cawaders.*.extra_hours' => [ 
                'required',
            ],
        ];
    }
}
