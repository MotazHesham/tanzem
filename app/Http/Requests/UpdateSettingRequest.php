<?php

namespace App\Http\Requests;

use App\Models\Setting;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSettingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('setting_edit');
    }

    public function rules()
    {
        return [
            'address' => [
                'string',
                'required',
            ],
            'phone_1' => [
                'string',
                'required',
            ],
            'phone_2' => [
                'string',
                'nullable',
            ],
            'email_1' => [
                'required',
            ],
            'facebook' => [
                'string',
                'nullable',
            ],
            'gmail' => [
                'string',
                'nullable',
            ],
            'linkedin' => [
                'string',
                'nullable',
            ],
            'instagram' => [
                'string',
                'nullable',
            ],
            'twitter' => [
                'string',
                'nullable',
            ],
            'latitude' => [
                'string',
                'nullable',
            ],
            'longitude' => [
                'string',
                'nullable',
            ],
            'home_text_1' => [
                'string',
                'nullable',
            ],
            'about_us' => [
                'required',
            ],
        ];
    }
}
