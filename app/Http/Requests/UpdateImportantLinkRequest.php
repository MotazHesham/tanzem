<?php

namespace App\Http\Requests;

use App\Models\ImportantLink;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateImportantLinkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('important_link_edit');
    }

    public function rules()
    {
        return [
            'text' => [
                'string',
                'required',
            ],
            'link' => [
                'string',
                'required',
            ],
        ];
    }
}
