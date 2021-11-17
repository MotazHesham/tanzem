<?php

namespace App\Http\Requests;

use App\Models\News;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateNewsRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('news_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'short_description' => [
                'string',
                'required',
            ],
            'long_description' => [
                'required',
            ],
            'photo' => [
                'required',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
