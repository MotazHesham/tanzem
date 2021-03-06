<?php

namespace App\Http\Requests;

use App\Models\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Auth;

class StoreEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_create') || Auth::user()->user_type == 'companiesAndInstitution'|| Auth::user()->user_type == 'client' || Auth::user()->user_type == 'governmental_entity';
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
                'start_date_check'
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
            'specializations.*' => [
                'integer',
            ],
            'specializations' => [
                'required',
                'array',
            ],

            'photos' => [
                'array',
            ],
            'videos' => [
                'array',
            ],
        ];
    }
}
