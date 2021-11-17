<?php

namespace App\Http\Requests;

use App\Models\SaidAboutTanzem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySaidAboutTanzemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('said_about_tanzem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:said_about_tanzems,id',
        ];
    }
}
