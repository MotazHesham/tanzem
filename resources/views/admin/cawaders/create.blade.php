@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.cawader.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.cawaders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-3">
                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                </div> 
                <div class="form-group col-md-3">
                    <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                </div> 
                <div class="form-group col-md-3">
                    <label class="required" for="dob">{{ trans('cruds.cawader.fields.dob') }}</label>
                    <input class="form-control date {{ $errors->has('dob') ? 'is-invalid' : '' }}" type="text" name="dob" id="dob" value="{{ old('dob') }}" required>
                    @if($errors->has('dob'))
                        <div class="invalid-feedback">
                            {{ $errors->first('dob') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cawader.fields.dob_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="city_id">{{ trans('cruds.cawader.fields.city') }}</label>
                    <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                        @foreach($cities as $id => $entry)
                            <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('city'))
                        <div class="invalid-feedback">
                            {{ $errors->first('city') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cawader.fields.city_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required">{{ trans('cruds.cawader.fields.degree') }}</label>
                    <select class="form-control {{ $errors->has('degree') ? 'is-invalid' : '' }}" name="degree" id="degree" required>
                        <option value disabled {{ old('degree', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Cawader::DEGREE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('degree', '') === (string) $key ? 'selected' : '' }}>{{ trans('global.degree.'.$label) }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('degree'))
                        <div class="invalid-feedback">
                            {{ $errors->first('degree') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cawader.fields.degree_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="working_hours">{{ trans('cruds.cawader.fields.working_hours') }}</label>
                    <input class="form-control {{ $errors->has('working_hours') ? 'is-invalid' : '' }}" type="number" name="working_hours" id="working_hours" value="{{ old('working_hours', '') }}" step="1" required>
                    @if($errors->has('working_hours'))
                        <div class="invalid-feedback">
                            {{ $errors->first('working_hours') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cawader.fields.working_hours_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="identity_number">{{ trans('cruds.cawader.fields.identity_number') }}</label>
                    <input class="form-control {{ $errors->has('identity_number') ? 'is-invalid' : '' }}" type="text" name="identity_number" id="identity_number" value="{{ old('identity_number', '') }}" required>
                    @if($errors->has('identity_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('identity_number') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cawader.fields.identity_number_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label for="companies_and_institution_id">{{ trans('cruds.cawader.fields.companies_and_institution') }}</label>
                    <select class="form-control select2 {{ $errors->has('companies_and_institution') ? 'is-invalid' : '' }}" name="companies_and_institution_id" id="companies_and_institution_id">
                        @foreach($companies_and_institutions as $id => $entry)
                            <option value="{{ $id }}" {{ old('companies_and_institution_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('companies_and_institution'))
                        <div class="invalid-feedback">
                            {{ $errors->first('companies_and_institution') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cawader.fields.companies_and_institution_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="specializations">{{ trans('cruds.cawader.fields.specialization') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('specializations') ? 'is-invalid' : '' }}" name="specializations[]" id="specializations" multiple required>
                        @foreach($specializations as $id => $specialization)
                            <option value="{{ $id }}" {{ in_array($id, old('specializations', [])) ? 'selected' : '' }}>{{ $specialization }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('specializations'))
                        <div class="invalid-feedback">
                            {{ $errors->first('specializations') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cawader.fields.specialization_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="desceiption">{{ trans('cruds.cawader.fields.desceiption') }}</label>
                    <textarea class="form-control {{ $errors->has('desceiption') ? 'is-invalid' : '' }}" name="desceiption" id="desceiption">{{ old('desceiption') }}</textarea>
                    @if($errors->has('desceiption'))
                        <div class="invalid-feedback">
                            {{ $errors->first('desceiption') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cawader.fields.desceiption_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="photo">{{ trans('cruds.user.fields.photo') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}"
                        id="photo-dropzone">
                    </div>
                    @if ($errors->has('photo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('photo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.photo_helper') }}</span>
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
@section('scripts')
    <script>
        Dropzone.options.photoDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($cawader->user) && $cawader->user->photo)
                    var file = {!! json_encode($cawader->user->photo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection