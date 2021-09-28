<?php

namespace App\Http\Requests;

use App\Models\CompaniesAndInstitution;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCompaniesAndInstitutionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('companies_and_institution_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:companies_and_institutions,id',
        ];
    }
}
