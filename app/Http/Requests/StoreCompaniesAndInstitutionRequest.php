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
            'user_id' => [
                'required',
                'integer',
            ],
            'specialization_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
