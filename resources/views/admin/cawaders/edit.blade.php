@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.cawader.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cawaders.update", [$cawader->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="dob">{{ trans('cruds.cawader.fields.dob') }}</label>
                <input class="form-control date {{ $errors->has('dob') ? 'is-invalid' : '' }}" type="text" name="dob" id="dob" value="{{ old('dob', $cawader->dob) }}" required>
                @if($errors->has('dob'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dob') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cawader.fields.dob_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city_id">{{ trans('cruds.cawader.fields.city') }}</label>
                <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                    @foreach($cities as $id => $entry)
                        <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $cawader->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cawader.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.cawader.fields.degree') }}</label>
                <select class="form-control {{ $errors->has('degree') ? 'is-invalid' : '' }}" name="degree" id="degree" required>
                    <option value disabled {{ old('degree', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Cawader::DEGREE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('degree', $cawader->degree) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('degree'))
                    <div class="invalid-feedback">
                        {{ $errors->first('degree') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cawader.fields.degree_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="specializations">{{ trans('cruds.cawader.fields.specialization') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('specializations') ? 'is-invalid' : '' }}" name="specializations[]" id="specializations" multiple required>
                    @foreach($specializations as $id => $specialization)
                        <option value="{{ $id }}" {{ (in_array($id, old('specializations', [])) || $cawader->specializations->contains($id)) ? 'selected' : '' }}>{{ $specialization }}</option>
                    @endforeach
                </select>
                @if($errors->has('specializations'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specializations') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cawader.fields.specialization_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="working_hours">{{ trans('cruds.cawader.fields.working_hours') }}</label>
                <input class="form-control {{ $errors->has('working_hours') ? 'is-invalid' : '' }}" type="number" name="working_hours" id="working_hours" value="{{ old('working_hours', $cawader->working_hours) }}" step="1" required>
                @if($errors->has('working_hours'))
                    <div class="invalid-feedback">
                        {{ $errors->first('working_hours') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cawader.fields.working_hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="identity_number">{{ trans('cruds.cawader.fields.identity_number') }}</label>
                <input class="form-control {{ $errors->has('identity_number') ? 'is-invalid' : '' }}" type="text" name="identity_number" id="identity_number" value="{{ old('identity_number', $cawader->identity_number) }}" required>
                @if($errors->has('identity_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('identity_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cawader.fields.identity_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.cawader.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $cawader->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cawader.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="companies_and_institution_id">{{ trans('cruds.cawader.fields.companies_and_institution') }}</label>
                <select class="form-control select2 {{ $errors->has('companies_and_institution') ? 'is-invalid' : '' }}" name="companies_and_institution_id" id="companies_and_institution_id">
                    @foreach($companies_and_institutions as $id => $entry)
                        <option value="{{ $id }}" {{ (old('companies_and_institution_id') ? old('companies_and_institution_id') : $cawader->companies_and_institution->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('companies_and_institution'))
                    <div class="invalid-feedback">
                        {{ $errors->first('companies_and_institution') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cawader.fields.companies_and_institution_helper') }}</span>
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