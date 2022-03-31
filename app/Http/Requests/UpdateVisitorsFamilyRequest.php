<?php

namespace App\Http\Requests;

use App\Models\VisitorsFamily;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVisitorsFamilyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('visitors_family_edit');
    }

    public function rules()
    {
        return [
            'visitor_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'gender' => [
                'required',
            ],
            'relation' => [
                'string',
                'required',
            ],
            'phone' => [
                'required',
                'size:10',
                'regex:/(05)[0-9]{8}/',
            ],
            'identity' => [
                'string',
                'required',
                'unique:visitors_families,identity,' . request()->visitor_family_id,
            ],
        ];
    }
}
