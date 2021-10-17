<?php

namespace App\Http\Requests;

use App\Models\Visitor;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVisitorRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('visitor_create');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
            'national' => [
                'string',
                'required',
            ],
            'events.*' => [
                'integer',
            ],
            'events' => [
                'array',
            ],
            'brands.*' => [
                'integer',
            ],
            'brands' => [
                'array',
            ],
        ];
    }
}
