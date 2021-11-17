<?php

namespace App\Http\Requests;

use App\Models\Cawader;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCawaderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cawader_edit');
    }

    public function rules()
    {
        return [
            'dob' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'city_id' => [
                'required',
                'integer',
            ],
            'degree' => [
                'required',
            ],
            'specializations.*' => [
                'integer',
            ],
            'specializations' => [
                'required',
                'array',
            ],
            'working_hours' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'identity_number' => [
                'string',
                'required',
            ],
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users,email,' . request()->user_id,
            ], 
            'photo' => [
                'required',
            ], 
            'phone' => [
                'required',
                'size:10',
                'regex:/(05)[0-9]{8}/', 
            ], 
        ];
    } 
}