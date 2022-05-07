<?php

namespace App\Http\Requests;

use App\Models\Client;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateClientRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('client_edit');
    }

    public function rules()
    {
        return [
            'commerical_num' => [
                'string',
                'required',
            ],
            'commerical_expiry' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'licence_num' => [
                'string',
                'required',
            ],
            'licence_expiry' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'specializations.*' => [
                'integer',
            ],
            'specializations' => [
                'required',
                'array',
            ],
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
