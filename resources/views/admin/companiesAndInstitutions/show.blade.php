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
                            {{ trans('cruds.companiesAndInstitution.fields.specializations') }}
                        </th>
                        <td>
                            @foreach($companiesAndInstitution->specializations as $key => $specializations)
                                <span class="label label-info">{{ $specializations->name_ar }}</span>
                            @endforeach
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

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#company_events" role="tab" data-toggle="tab">
                {{ trans('cruds.event.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="company_events">
            @includeIf('admin.companiesAndInstitutions.relationships.companyEvents', ['events' => $companiesAndInstitution->companyEvents])
        </div>
    </div>
</div>

@endsection