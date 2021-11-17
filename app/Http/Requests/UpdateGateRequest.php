<?php

namespace App\Http\Requests;

use App\Models\Gate as EventGate;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGateRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('gate_edit');
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
        ];
    }
}
