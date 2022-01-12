<?php

namespace App\Http\Requests;

use App\Models\CawaderSpecialization;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCawaderSpecializationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cawader_specialization_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cawader_specializations,id',
        ];
    }
}