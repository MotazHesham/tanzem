<?php

namespace App\Http\Requests;

use App\Models\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Gate as PermissionGate;


class UpdateGateRequest extends FormRequest
{
    public function authorize()
    {
        return PermissionGate::allows('gate_edit');
    }

    public function rules()
    {
        return [
            'gate' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'event_id' => [
                'required',
                'integer',
            ],
            'zone_name' => [
                'string',
                'required',
            ],
            'latitude' => [
                'required',
            ],
            'longitude' => [
                'required',
            ],
        ];
    }
}
