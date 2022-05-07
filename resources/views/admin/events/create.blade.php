@extends('layouts.admin')
@section('styles')
    <style>

    </style>
@endsection
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.event.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data" id="store_event">
                @csrf
                <input type="hidden" name="status" value="active">

                <div class="row">
                    <div class="form-group col-md-2">
                        <label class="required" for="company_id">{{ trans('cruds.event.fields.company') }}</label>
                        <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id"
                            id="company_id" required>
                            @foreach ($companies as $id => $entry)
                                <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('company'))
                            <div class="invalid-feedback">
                                {{ $errors->first('company') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.company_helper') }}</span>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="required" for="client_id">{{ trans('cruds.event.fields.client') }}</label>
                        <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id"
                            id="client_id" required>
                            @foreach ($clients as $id => $entry)
                                <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('client'))
                            <div class="invalid-feedback">
                                {{ $errors->first('client') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.client_helper') }}</span>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="required" for="government_id">{{ trans('cruds.event.fields.government') }}</label>
                        <select class="form-control select2 {{ $errors->has('government') ? 'is-invalid' : '' }}"
                            name="government_id" id="government_id" required>
                            @foreach ($governments as $id => $entry)
                                <option value="{{ $id }}" {{ old('government_id') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('government'))
                            <div class="invalid-feedback">
                                {{ $errors->first('government') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.government_helper') }}</span>
                    </div>
                    @include('admin.events.forms.create')
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
    @include('map_scripts.events.create') 
    <script>
        Dropzone.options.photoDropzone = {
            url: '{{ route('admin.events.storeMedia') }}',
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
                @if (isset($event) && $event->photo)
                    var file = {!! json_encode($event->photo) !!}
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
        var uploadedPhotosMap = {}
    Dropzone.options.photosDropzone = {
        url: '{{ route('admin.events.storeMedia') }}',
        maxFilesize: 4, // MB
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        addRemoveLinks: true,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
          size: 4,
          width: 4096,
          height: 4096
        },
        success: function (file, response) {
          $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
          uploadedPhotosMap[file.name] = response.name
        },
        removedfile: function (file) {
          console.log(file)
          file.previewElement.remove()
          var name = ''
          if (typeof file.file_name !== 'undefined') {
            name = file.file_name
          } else {
            name = uploadedPhotosMap[file.name]
          }
          $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
        },
        init: function () {
    @if(isset($event) && $event->photos)
          var files = {!! json_encode($event->photos) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              this.options.thumbnail.call(this, file, file.preview)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
            }
    @endif
        },
         error: function (file, response) {
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
        url: '{{ route('admin.events.storeMedia') }}',
        maxFilesize: 10, // MB
        addRemoveLinks: true,
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
          size: 10
        },
        success: function (file, response) {
          $('form').append('<input type="hidden" name="videos[]" value="' + response.name + '">')
          uploadedVideosMap[file.name] = response.name
        },
        removedfile: function (file) {
          file.previewElement.remove()
          var name = ''
          if (typeof file.file_name !== 'undefined') {
            name = file.file_name
          } else {
            name = uploadedVideosMap[file.name]
          }
          $('form').find('input[name="videos[]"][value="' + name + '"]').remove()
        },
        init: function () {
    @if(isset($event) && $event->videos)
              var files =
                {!! json_encode($event->videos) !!}
                  for (var i in files) {
                  var file = files[i]
                  this.options.addedfile.call(this, file)
                  file.previewElement.classList.add('dz-complete')
                  $('form').append('<input type="hidden" name="videos[]" value="' + file.file_name + '">')
                }
    @endif
        },
         error: function (file, response) {
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
