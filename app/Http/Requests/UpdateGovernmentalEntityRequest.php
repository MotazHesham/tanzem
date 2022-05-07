<?php

namespace App\Http\Requests;

use App\Models\GovernmentalEntity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGovernmentalEntityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('governmental_entity_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'unique:users,email,' . request()->user_id,
            ], 
            'phone' => [
                'required',
                'size:10',
                'regex:/(05)[0-9]{8}/', 
                'unique:users,phone,' . request()->user_id,
            ], 
            'landline_phone' => [
                'string',
                'nullable',
            ],
            'website' => [
                'string',
                'required',
            ],
        ];
    } 
}
