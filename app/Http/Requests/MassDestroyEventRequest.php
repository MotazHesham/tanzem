<?php

namespace App\Http\Requests;

use App\Models\Event;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class MassDestroyEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_delete') || Auth::user()->user_type == 'companiesAndInstitution'|| Auth::user()->user_type == 'client'; 
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:events,id',
        ];
    }
}
