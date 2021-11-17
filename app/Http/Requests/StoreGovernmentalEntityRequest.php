<?php

namespace App\Http\Requests;

use App\Models\GovernmentalEntity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreGovernmentalEntityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('governmental_entity_create');
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
                'unique:users',
            ],
            'password' => [
                'required',
            ], 
            'phone' => [
                'required',
                'size:10',
                'regex:/(05)[0-9]{8}/', 
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
