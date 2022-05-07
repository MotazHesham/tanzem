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
            <input type="hidden" name="user_id" value="{{ $cawader->user->id}}" id="">

            <div class="row">
                <div class="form-group col-md-3">
                    <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $cawader->user->name) }}" required>
                    @if($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $cawader->user->email) }}" required>
                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $cawader->user->phone) }}" required>
                    @if($errors->has('phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="dob">{{ trans('cruds.cawader.fields.dob') }}</label>
                    <input class="form-control date {{ $errors->has('dob') ? 'is-invalid' : '' }}" type="text" name="dob" id="dob" value="{{ old('dob', $cawader->dob) }}" required>
                    @if($errors->has('dob'))
                        <div class="invalid-feedback">
                            {{ $errors->first('dob') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cawader.fields.dob_helper') }}</span>
                </div>
             <!--  <div class="form-group col-md-3">
                    <label>{{ trans('cruds.cawader.fields.has_skills') }}</label>
                    @foreach(App\Models\Cawader::HAS_SKILLS_RADIO as $key => $label)
                        <div class="form-check {{ $errors->has('has_skills') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="radio" id="has_skills_{{ $key }}" name="has_skills" value="{{ $key }}" {{ old('has_skills', $cawader->has_skills) === (string) $key ? 'checked' : '' }}>
                            <label class="form-check-label" for="has_skills_{{ $key }}">{{ trans('global.'.$label)}}</label>
                        </div>
                    @endforeach
                    @if($errors->has('has_skills'))
                        <div class="invalid-feedback">
                            {{ $errors->first('has_skills') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cawader.fields.has_skills_helper') }}</span>
                </div>-->
            <div class="form-group col-md-12" id="skillDIV" style="">
                <label for="skills">{{ trans('cruds.cawader.fields.skill') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('skills') ? 'is-invalid' : '' }}" name="skills[]" id="skills" multiple>
                    @foreach($skills as $id => $skill)
                        <option value="{{ $id }}" {{ (in_array($id, old('skills', [])) || $cawader->skills->contains($id)) ? 'selected' : '' }}>{{ $skill }}</option>
                    @endforeach
                </select>
                @if($errors->has('skills'))
                    <div class="invalid-feedback">
                        {{ $errors->first('skills') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cawader.fields.skill_helper') }}</span>
            </div>
                <div class="form-group col-md-3">
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
                <div class="form-group col-md-3">
                    <label class="required">{{ trans('cruds.cawader.fields.degree') }}</label>
                    <select class="form-control {{ $errors->has('degree') ? 'is-invalid' : '' }}" name="degree" id="degree" required>
                        <option value disabled {{ old('degree', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\Cawader::DEGREE_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('degree', $cawader->degree) === (string) $key ? 'selected' : '' }}>{{ trans('global.degree.'.$label) }}</option>
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
                    <input class="form-control {{ $errors->has('working_hours') ? 'is-invalid' : '' }}" type="number" name="working_hours" id="working_hours" value="{{ old('working_hours', $cawader->working_hours) }}" step="1" required>
                    @if($errors->has('working_hours'))
                        <div class="invalid-feedback">
                            {{ $errors->first('working_hours') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cawader.fields.working_hours_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="identity_number">{{ trans('cruds.cawader.fields.identity_number') }}</label>
                    <input class="form-control {{ $errors->has('identity_number') ? 'is-invalid' : '' }}" type="text" name="identity_number" id="identity_number" value="{{ old('identity_number', $cawader->identity_number) }}" required>
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
                <div class="form-group col-md-3">
                    <label for="experience_years">{{ trans('cruds.cawader.fields.experience_years') }}</label>
                    <input class="form-control {{ $errors->has('experience_years') ? 'is-invalid' : '' }}" type="number" name="experience_years" id="experience_years" value="{{ old('experience_years', $cawader->experience_years) }}" step="1">
                    @if($errors->has('experience_years'))
                        <div class="invalid-feedback">
                            {{ $errors->first('experience_years') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cawader.fields.experience_years_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
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
                <div class="form-group col-md-6">
                    <label for="desceiption">{{ trans('cruds.cawader.fields.desceiption') }}</label>
                    <textarea class="form-control {{ $errors->has('desceiption') ? 'is-invalid' : '' }}" name="desceiption" id="desceiption">{{ old('desceiption', $cawader->desceiption) }}</textarea>
                    @if($errors->has('desceiption'))
                        <div class="invalid-feedback">
                            {{ $errors->first('desceiption') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cawader.fields.desceiption_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label>{{ trans('cruds.cawader.fields.health_status') }}</label>
                    @foreach(App\Models\User::HAS_health_status_RADIO as $key => $label)
                        <div class="form-check {{ $errors->has('health_status') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="radio" id="health_status{{ $key }}" name="health_status" value="{{ $key }}" {{ old('health_status', $cawader->user->health_status) === $key ? 'checked' : '' }}>
                            <label class="form-check-label" for="health_status{{ $key }}">{{ trans('global.'.$label)}}</label>
                        </div>
                    @endforeach
                    @if($errors->has('health_status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('health_status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.cawader.fields.health_status_helper') }}</span>
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
     <script>
        $('input:radio[name="has_skills"]').change(
         function(){
             if ($(this).is(':checked') && $(this).val() == '1') {
               var x = document.getElementById("skillDIV");
                 x.style.display = "block";
             }
             else{
             var x = document.getElementById("skillDIV");
                 x.style.display = "none";
             }
         });
             </script>
@endsection
