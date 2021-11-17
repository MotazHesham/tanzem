@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.governmentalEntity.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.governmental-entities.update", [$governmentalEntity->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="user_id" value="{{ $governmentalEntity->user->id}}" id="">

            <div class="row">
                <div class="form-group col-md-6">
                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $governmentalEntity->user->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $governmentalEntity->user->email) }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                </div> 
                <div class="form-group col-md-6">
                    <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $governmentalEntity->user->phone) }}" required>
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="landline_phone">{{ trans('cruds.user.fields.landline_phone') }}</label>
                    <input class="form-control {{ $errors->has('landline_phone') ? 'is-invalid' : '' }}" type="text" name="landline_phone" id="landline_phone" value="{{ old('landline_phone', $governmentalEntity->user->landline_phone) }}">
                    @if($errors->has('landline_phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('landline_phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.landline_phone_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="website">{{ trans('cruds.user.fields.website') }}</label>
                    <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', $governmentalEntity->user->website) }}" required>
                    @if($errors->has('website'))
                        <div class="invalid-feedback">
                            {{ $errors->first('website') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.website_helper') }}</span>
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