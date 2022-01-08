<?php

namespace App\Http\Requests;

use App\Models\Brand;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class MassDestroyBrandRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('brand_delete') || Auth::user()->user_type == 'companiesAndInstitution'|| Auth::user()->user_type == 'client'; 
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:brands,id',
        ];
    }
}
