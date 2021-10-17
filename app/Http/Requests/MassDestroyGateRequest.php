<?php

namespace App\Http\Requests;

use App\Models\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyGateRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('gate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:gates,id',
        ];
    }
}
