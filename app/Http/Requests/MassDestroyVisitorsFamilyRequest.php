<?php

namespace App\Http\Requests;

use App\Models\VisitorsFamily;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVisitorsFamilyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('visitors_family_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:visitors_families,id',
        ];
    }
}
