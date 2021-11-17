<?php

namespace App\Http\Requests;

use App\Models\Contactu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateContactuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('contactu_edit');
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
            ],
            'phone' => [
                'string',
                'required',
            ],
            'title' => [
                'string',
                'required',
            ],
            'message' => [
                'required',
            ],
        ];
    }
}
