<?php

namespace App\Http\Requests;

use App\Models\News;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class MassDestroyNewsRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('news_delete') || Auth::user()->user_type == 'governmental_entity' || Auth::user()->user_type == 'companiesAndInstitution'|| Auth::user()->user_type == 'client'; 
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:news,id',
        ];
    }
}
