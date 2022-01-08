<?php

namespace App\Http\Requests;

use App\Models\Cawader;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class MassDestroyCawaderRequest extends FormRequest
{
    public function authorize()
    {  
        return Gate::allows('cawader_delete') || Auth::user()->user_type == 'companiesAndInstitution'|| Auth::user()->user_type == 'client';
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cawaders,id',
        ];
    }
}
