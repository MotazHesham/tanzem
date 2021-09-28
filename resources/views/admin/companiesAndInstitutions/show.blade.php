@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.companiesAndInstitution.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.companies-and-institutions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.id') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.commerical_num') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->commerical_num }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.commerical_expiry') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->commerical_expiry }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.licence_num') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->licence_num }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.licence_expiry') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->licence_expiry }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.user') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->user->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.specialization') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->specialization->name_ar ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.companies-and-institutions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection