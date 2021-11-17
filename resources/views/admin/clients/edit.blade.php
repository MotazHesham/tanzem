@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.client.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.clients.update", [$client->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="user_id" value="{{ $client->user->id}}" id="">

            <div class="row">
                <div class="form-group col-md-6">
                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $client->user->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $client->user->email) }}" required>
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
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $client->user->phone) }}" required>
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="landline_phone">{{ trans('cruds.user.fields.landline_phone') }}</label>
                    <input class="form-control {{ $errors->has('landline_phone') ? 'is-invalid' : '' }}" type="text" name="landline_phone" id="landline_phone" value="{{ old('landline_phone', $client->user->landline_phone) }}">
                    @if($errors->has('landline_phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('landline_phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.landline_phone_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="website">{{ trans('cruds.user.fields.website') }}</label>
                    <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', $client->user->website) }}" required>
                    @if($errors->has('website'))
                        <div class="invalid-feedback">
                            {{ $errors->first('website') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.website_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="commerical_num">{{ trans('cruds.client.fields.commerical_num') }}</label>
                    <input class="form-control {{ $errors->has('commerical_num') ? 'is-invalid' : '' }}" type="text" name="commerical_num" id="commerical_num" value="{{ old('commerical_num', $client->commerical_num) }}" required>
                    @if($errors->has('commerical_num'))
                        <div class="invalid-feedback">
                            {{ $errors->first('commerical_num') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.commerical_num_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="commerical_expiry">{{ trans('cruds.client.fields.commerical_expiry') }}</label>
                    <input class="form-control date {{ $errors->has('commerical_expiry') ? 'is-invalid' : '' }}" type="text" name="commerical_expiry" id="commerical_expiry" value="{{ old('commerical_expiry', $client->commerical_expiry) }}" required>
                    @if($errors->has('commerical_expiry'))
                        <div class="invalid-feedback">
                            {{ $errors->first('commerical_expiry') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.commerical_expiry_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="licence_num">{{ trans('cruds.client.fields.licence_num') }}</label>
                    <input class="form-control {{ $errors->has('licence_num') ? 'is-invalid' : '' }}" type="text" name="licence_num" id="licence_num" value="{{ old('licence_num', $client->licence_num) }}" required>
                    @if($errors->has('licence_num'))
                        <div class="invalid-feedback">
                            {{ $errors->first('licence_num') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.licence_num_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="licence_expiry">{{ trans('cruds.client.fields.licence_expiry') }}</label>
                    <input class="form-control date {{ $errors->has('licence_expiry') ? 'is-invalid' : '' }}" type="text" name="licence_expiry" id="licence_expiry" value="{{ old('licence_expiry', $client->licence_expiry) }}" required>
                    @if($errors->has('licence_expiry'))
                        <div class="invalid-feedback">
                            {{ $errors->first('licence_expiry') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.licence_expiry_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="specializations">{{ trans('cruds.client.fields.specialization') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('specializations') ? 'is-invalid' : '' }}" name="specializations[]" id="specializations" multiple required>
                        @foreach($specializations as $id => $specialization)
                            <option value="{{ $id }}" {{ (in_array($id, old('specializations', [])) || $client->specializations->contains($id)) ? 'selected' : '' }}>{{ $specialization }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('specializations'))
                        <div class="invalid-feedback">
                            {{ $errors->first('specializations') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.client.fields.specialization_helper') }}</span>
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