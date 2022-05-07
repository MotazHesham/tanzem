<?php

namespace App\Http\Requests;

use App\Models\VisitorsFamily;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVisitorsFamilyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('visitors_family_create');
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
                'unique:users',
            ],
            'identity' => [
                'string',
                'required',
                'unique:visitors_families,identity',
                'regex:/(10)[0-9]{8}|(11)[0-9]{8}|(12)[0-9]{8}|(13)[0-9]{8}|(14)[0-9]{8}|(15)[0-9]{8}|(20)[0-9]{8}|(21)[0-9]{8}|(22)[0-9]{8}|(23)[0-9]{8}|(24)[0-9]{8}|(25)[0-9]{8}/',                
                'unique:users',
            ],
        ];
    }
}
