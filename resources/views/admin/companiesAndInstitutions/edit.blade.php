@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.companiesAndInstitution.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.companies-and-institutions.update", [$companiesAndInstitution->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="commerical_num">{{ trans('cruds.companiesAndInstitution.fields.commerical_num') }}</label>
                <input class="form-control {{ $errors->has('commerical_num') ? 'is-invalid' : '' }}" type="text" name="commerical_num" id="commerical_num" value="{{ old('commerical_num', $companiesAndInstitution->commerical_num) }}" required>
                @if($errors->has('commerical_num'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commerical_num') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.commerical_num_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="commerical_expiry">{{ trans('cruds.companiesAndInstitution.fields.commerical_expiry') }}</label>
                <input class="form-control date {{ $errors->has('commerical_expiry') ? 'is-invalid' : '' }}" type="text" name="commerical_expiry" id="commerical_expiry" value="{{ old('commerical_expiry', $companiesAndInstitution->commerical_expiry) }}" required>
                @if($errors->has('commerical_expiry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('commerical_expiry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.commerical_expiry_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="licence_num">{{ trans('cruds.companiesAndInstitution.fields.licence_num') }}</label>
                <input class="form-control {{ $errors->has('licence_num') ? 'is-invalid' : '' }}" type="text" name="licence_num" id="licence_num" value="{{ old('licence_num', $companiesAndInstitution->licence_num) }}" required>
                @if($errors->has('licence_num'))
                    <div class="invalid-feedback">
                        {{ $errors->first('licence_num') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.licence_num_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="licence_expiry">{{ trans('cruds.companiesAndInstitution.fields.licence_expiry') }}</label>
                <input class="form-control date {{ $errors->has('licence_expiry') ? 'is-invalid' : '' }}" type="text" name="licence_expiry" id="licence_expiry" value="{{ old('licence_expiry', $companiesAndInstitution->licence_expiry) }}" required>
                @if($errors->has('licence_expiry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('licence_expiry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.licence_expiry_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.companiesAndInstitution.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $companiesAndInstitution->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="specialization_id">{{ trans('cruds.companiesAndInstitution.fields.specialization') }}</label>
                <select class="form-control select2 {{ $errors->has('specialization') ? 'is-invalid' : '' }}" name="specialization_id" id="specialization_id" required>
                    @foreach($specializations as $id => $entry)
                        <option value="{{ $id }}" {{ (old('specialization_id') ? old('specialization_id') : $companiesAndInstitution->specialization->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('specialization'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specialization') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.specialization_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection