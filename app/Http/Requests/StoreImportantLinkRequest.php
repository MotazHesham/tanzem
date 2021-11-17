<?php

namespace App\Http\Requests;

use App\Models\ImportantLink;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreImportantLinkRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('important_link_create');
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
