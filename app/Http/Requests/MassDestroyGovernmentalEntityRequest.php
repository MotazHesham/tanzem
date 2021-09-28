<?php

namespace App\Http\Requests;

use App\Models\GovernmentalEntity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGovernmentalEntityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('governmental_entity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:governmental_entities,id',
        ];
    }
}
