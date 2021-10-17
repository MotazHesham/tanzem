<?php

namespace App\Http\Requests;

use App\Models\Brand;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBrandRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('brand_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
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
