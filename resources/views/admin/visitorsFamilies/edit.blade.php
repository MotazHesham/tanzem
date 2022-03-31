@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.visitorsFamily.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.visitors-families.update", [$visitorsFamily->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="visitor_family_id" value="{{ $visitorsFamily->id }}">
            <input type="hidden" name="visitor_id" value="{{ $visitorsFamily->visitor->id }}">
            <div class="row">
                <div class="form-group col-md-3">
                    <label class="required" for="name">{{ trans('cruds.visitorsFamily.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $visitorsFamily->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.visitorsFamily.fields.name_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">{{ trans('cruds.visitorsFamily.fields.gender') }}</label>
                    <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                        <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\VisitorsFamily::GENDER_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('gender', $visitorsFamily->gender) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('gender'))
                        <div class="invalid-feedback">
                            {{ $errors->first('gender') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.visitorsFamily.fields.gender_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="relation">{{ trans('cruds.visitorsFamily.fields.relation') }}</label>
                    <input class="form-control {{ $errors->has('relation') ? 'is-invalid' : '' }}" type="text" name="relation" id="relation" value="{{ old('relation', $visitorsFamily->relation) }}" required>
                    @if($errors->has('relation'))
                        <div class="invalid-feedback">
                            {{ $errors->first('relation') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.visitorsFamily.fields.relation_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="phone">{{ trans('cruds.visitorsFamily.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $visitorsFamily->phone) }}" required>
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.visitorsFamily.fields.phone_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="identity">{{ trans('cruds.visitorsFamily.fields.identity') }}</label>
                    <input class="form-control {{ $errors->has('identity') ? 'is-invalid' : '' }}" type="text" name="identity" id="identity" value="{{ old('identity', $visitorsFamily->identity) }}" required>
                    @if($errors->has('identity'))
                        <div class="invalid-feedback">
                            {{ $errors->first('identity') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.visitorsFamily.fields.identity_helper') }}</span>
                </div>
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
