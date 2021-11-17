<?php

namespace App\Http\Requests;

use App\Models\CompaniesAndInstitution;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCompaniesAndInstitutionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('companies_and_institution_create');
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
            'photo' => [
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
            'galery' => [
                'array',
            ],
            'videos' => [
                'array',
            ],
            'city_id' => [
                'required',
                'integer',
            ],
            'about_company' => [
                'required',
            ],
            'facebook' => [
                'string',
                'nullable',
            ],
            'gmail' => [
                'string',
                'nullable',
            ],
            'linked' => [
                'string',
                'nullable',
            ],
            'instagram' => [
                'string',
                'nullable',
            ],
            'twitter' => [
                'string',
                'nullable',
            ],
        ];
    } 
}
