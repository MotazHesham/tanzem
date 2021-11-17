@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cawader.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cawaders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.id') }}
                        </th>
                        <td>
                            {{ $cawader->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $cawader->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $cawader->user->email ?? '' }}
                        </td>
                    </tr> 
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <td>
                            {{ $cawader->user->phone ?? '' }}
                        </td>
                    </tr> 
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.dob') }}
                        </th>
                        <td>
                            {{ $cawader->dob }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.city') }}
                        </th>
                        <td>
                            {{ $cawader->city->name_ar ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.degree') }}
                        </th>
                        <td>
                            {{ trans('global.degree.'.$cawader->degree) ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.specialization') }}
                        </th>
                        <td>
                            @foreach($cawader->specializations as $key => $specialization)
                                <span class="badge badge-info">{{ $specialization->name_ar }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.working_hours') }}
                        </th>
                        <td>
                            {{ $cawader->working_hours }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.identity_number') }}
                        </th>
                        <td>
                            {{ $cawader->identity_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.companies_and_institution') }}
                        </th>
                        <td>
                            {{ $cawader->companies_and_institution->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.photo') }}
                        </th>
                        <td>
                            @if($cawader->user && $cawader->user->photo)
                                <a href="{{ $cawader->user->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $cawader->user->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.desceiption') }}
                        </th>
                        <td>
                            {{ $cawader->desceiption }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cawaders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection