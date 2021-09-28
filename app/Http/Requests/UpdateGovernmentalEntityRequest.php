<?php

namespace App\Http\Requests;

use App\Models\GovernmentalEntity;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateGovernmentalEntityRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('governmental_entity_edit');
    }

    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
