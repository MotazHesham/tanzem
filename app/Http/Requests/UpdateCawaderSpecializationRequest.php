<?php

namespace App\Http\Requests;

use App\Models\CawaderSpecialization;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCawaderSpecializationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cawader_specialization_edit');
    }

    public function rules()
    {
        return [
            'name_ar' => [
                'string',
                'required',
            ],
            'name_en' => [
                'string',
                'required',
            ],
        ];
    }
}