<?php

namespace App\Http\Requests;

use App\Models\SaidAboutTanzem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSaidAboutTanzemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('said_about_tanzem_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'job_position' => [
                'string',
                'required',
            ],
            'photo' => [
                'required',
            ],
            'text_1' => [
                'string',
                'required',
            ],
            'text_2' => [
                'required',
            ],
        ];
    }
}
