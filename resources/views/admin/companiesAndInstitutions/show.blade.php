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
                            {{ trans('cruds.user.fields.name') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->user->email ?? '' }}
                        </td>
                    </tr> 
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.phone') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->user->phone ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.landline_phone') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->user->landline_phone ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.website') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->user->website ?? '' }}
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
                            {{ trans('cruds.companiesAndInstitution.fields.specializations') }}
                        </th>
                        <td>
                            @foreach($companiesAndInstitution->specializations as $key => $specialization)
                                <span class="badge badge-info">{{ $specialization->name_ar }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user.fields.photo') }}
                        </th>
                        <td>
                            @if($companiesAndInstitution->user && $companiesAndInstitution->user->photo)
                                <a href="{{ $companiesAndInstitution->user->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $companiesAndInstitution->user->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.galery') }}
                        </th>
                        <td>
                            @foreach($companiesAndInstitution->galery as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.videos') }}
                        </th>
                        <td>
                            @foreach($companiesAndInstitution->videos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.city') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->city->name_ar ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.about_company') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->about_company }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.facebook') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->facebook }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.gmail') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->gmail }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.linked') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->linked }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.instagram') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->instagram }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.twitter') }}
                        </th>
                        <td>
                            {{ $companiesAndInstitution->twitter }}
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