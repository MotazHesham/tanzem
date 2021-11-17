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
            <input type="hidden" name="user_id" value="{{ $companiesAndInstitution->user->id}}" id="">

            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $companiesAndInstitution->user->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $companiesAndInstitution->user->email) }}" required>
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
                            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $companiesAndInstitution->user->phone) }}" required>
                            @if($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="landline_phone">{{ trans('cruds.user.fields.landline_phone') }}</label>
                            <input class="form-control {{ $errors->has('landline_phone') ? 'is-invalid' : '' }}" type="text" name="landline_phone" id="landline_phone" value="{{ old('landline_phone', $companiesAndInstitution->user->landline_phone) }}">
                            @if($errors->has('landline_phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('landline_phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.landline_phone_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required" for="website">{{ trans('cruds.user.fields.website') }}</label>
                            <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', $companiesAndInstitution->user->website) }}" required>
                            @if($errors->has('website'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('website') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.website_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required" for="city_id">{{ trans('cruds.companiesAndInstitution.fields.city') }}</label>
                            <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id" required>
                                @foreach($cities as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('city_id') ? old('city_id') : $companiesAndInstitution->city->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('city'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('city') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.city_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="twitter">{{ trans('cruds.companiesAndInstitution.fields.twitter') }}</label>
                            <input class="form-control {{ $errors->has('twitter') ? 'is-invalid' : '' }}" type="text" name="twitter" id="twitter" value="{{ old('twitter', $companiesAndInstitution->twitter) }}">
                            @if($errors->has('twitter'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('twitter') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.twitter_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="facebook">{{ trans('cruds.companiesAndInstitution.fields.facebook') }}</label>
                            <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="text" name="facebook" id="facebook" value="{{ old('facebook', $companiesAndInstitution->facebook) }}">
                            @if($errors->has('facebook'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('facebook') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.facebook_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="gmail">{{ trans('cruds.companiesAndInstitution.fields.gmail') }}</label>
                            <input class="form-control {{ $errors->has('gmail') ? 'is-invalid' : '' }}" type="text" name="gmail" id="gmail" value="{{ old('gmail', $companiesAndInstitution->gmail) }}">
                            @if($errors->has('gmail'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gmail') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.gmail_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="linked">{{ trans('cruds.companiesAndInstitution.fields.linked') }}</label>
                            <input class="form-control {{ $errors->has('linked') ? 'is-invalid' : '' }}" type="text" name="linked" id="linked" value="{{ old('linked', $companiesAndInstitution->linked) }}">
                            @if($errors->has('linked'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('linked') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.linked_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="instagram">{{ trans('cruds.companiesAndInstitution.fields.instagram') }}</label>
                            <input class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" type="text" name="instagram" id="instagram" value="{{ old('instagram', $companiesAndInstitution->instagram) }}">
                            @if($errors->has('instagram'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('instagram') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.instagram_helper') }}</span>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="required" for="about_company">{{ trans('cruds.companiesAndInstitution.fields.about_company') }}</label>
                            <textarea class="form-control {{ $errors->has('about_company') ? 'is-invalid' : '' }}" name="about_company" id="about_company" required>{{ old('about_company', $companiesAndInstitution->about_company) }}</textarea>
                            @if($errors->has('about_company'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('about_company') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.about_company_helper') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="required" for="commerical_num">{{ trans('cruds.companiesAndInstitution.fields.commerical_num') }}</label>
                            <input class="form-control {{ $errors->has('commerical_num') ? 'is-invalid' : '' }}" type="text" name="commerical_num" id="commerical_num" value="{{ old('commerical_num', $companiesAndInstitution->commerical_num) }}" required>
                            @if($errors->has('commerical_num'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('commerical_num') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.commerical_num_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required" for="commerical_expiry">{{ trans('cruds.companiesAndInstitution.fields.commerical_expiry') }}</label>
                            <input class="form-control date {{ $errors->has('commerical_expiry') ? 'is-invalid' : '' }}" type="text" name="commerical_expiry" id="commerical_expiry" value="{{ old('commerical_expiry', $companiesAndInstitution->commerical_expiry) }}" required>
                            @if($errors->has('commerical_expiry'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('commerical_expiry') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.commerical_expiry_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required" for="licence_num">{{ trans('cruds.companiesAndInstitution.fields.licence_num') }}</label>
                            <input class="form-control {{ $errors->has('licence_num') ? 'is-invalid' : '' }}" type="text" name="licence_num" id="licence_num" value="{{ old('licence_num', $companiesAndInstitution->licence_num) }}" required>
                            @if($errors->has('licence_num'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('licence_num') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.licence_num_helper') }}</span>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="required" for="licence_expiry">{{ trans('cruds.companiesAndInstitution.fields.licence_expiry') }}</label>
                            <input class="form-control date {{ $errors->has('licence_expiry') ? 'is-invalid' : '' }}" type="text" name="licence_expiry" id="licence_expiry" value="{{ old('licence_expiry', $companiesAndInstitution->licence_expiry) }}" required>
                            @if($errors->has('licence_expiry'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('licence_expiry') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.licence_expiry_helper') }}</span>
                        </div> 
                    </div> 
                    <div class="form-group">
                        <label class="required" for="specializations">{{ trans('cruds.companiesAndInstitution.fields.specializations') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('specializations') ? 'is-invalid' : '' }}" name="specializations[]" id="specializations" multiple required>
                            @foreach($specializations as $id => $specialization)
                                <option value="{{ $id }}" {{ (in_array($id, old('specializations', [])) || $companiesAndInstitution->specializations->contains($id)) ? 'selected' : '' }}>{{ $specialization }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('specializations'))
                            <div class="invalid-feedback">
                                {{ $errors->first('specializations') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.specializations_helper') }}</span>
                    </div> 
                    <div class="form-group">
                        <label class="required" for="photo">{{ trans('cruds.user.fields.photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                        </div>
                        @if($errors->has('photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.photo_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="galery">{{ trans('cruds.companiesAndInstitution.fields.galery') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('galery') ? 'is-invalid' : '' }}" id="galery-dropzone">
                        </div>
                        @if($errors->has('galery'))
                            <div class="invalid-feedback">
                                {{ $errors->first('galery') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.galery_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="videos">{{ trans('cruds.companiesAndInstitution.fields.videos') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('videos') ? 'is-invalid' : '' }}" id="videos-dropzone">
                        </div>
                        @if($errors->has('videos'))
                            <div class="invalid-feedback">
                                {{ $errors->first('videos') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.videos_helper') }}</span>
                    </div> 
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
                @if (isset($companiesAndInstitution->user) && $companiesAndInstitution->user->photo)
                    var file = {!! json_encode($companiesAndInstitution->user->photo) !!}
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
        var uploadedGaleryMap = {}
        Dropzone.options.galeryDropzone = {
            url: '{{ route('admin.companies-and-institutions.storeMedia') }}',
            maxFilesize: 5, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="galery[]" value="' + response.name + '">')
                uploadedGaleryMap[file.name] = response.name
            },
            removedfile: function(file) {
                console.log(file)
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedGaleryMap[file.name]
                }
                $('form').find('input[name="galery[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($companiesAndInstitution) && $companiesAndInstitution->galery)
                    var files = {!! json_encode($companiesAndInstitution->galery) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="galery[]" value="' + file.file_name + '">')
                    }
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
        var uploadedVideosMap = {}
        Dropzone.options.videosDropzone = {
            url: '{{ route('admin.companies-and-institutions.storeMedia') }}',
            maxFilesize: 30, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 30
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="videos[]" value="' + response.name + '">')
                uploadedVideosMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedVideosMap[file.name]
                }
                $('form').find('input[name="videos[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($companiesAndInstitution) && $companiesAndInstitution->videos)
                    var files =
                    {!! json_encode($companiesAndInstitution->videos) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="videos[]" value="' + file.file_name + '">')
                    }
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
