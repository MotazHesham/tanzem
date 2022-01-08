@extends('layouts.company')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.brand.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("company.brands.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                    
                <div class="form-group col-md-6">
                    <label class="required" for="title">{{ trans('cruds.brand.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                    @if($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.brand.fields.title_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="event_id">{{ trans('cruds.brand.fields.event') }}</label>
                    <select class="form-control select2 {{ $errors->has('event') ? 'is-invalid' : '' }}" name="event_id" id="event_id" required>
                        @foreach($events as $id => $entry)
                            <option value="{{ $id }}" {{ old('event_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('event'))
                        <div class="invalid-feedback">
                            {{ $errors->first('event') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.brand.fields.event_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="description">{{ trans('cruds.brand.fields.description') }}</label>
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description') }}</textarea>
                    @if($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.brand.fields.description_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="photo">{{ trans('cruds.brand.fields.photo') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                    </div>
                    @if($errors->has('photo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('photo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.brand.fields.photo_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="zone_name">{{ trans('cruds.brand.fields.zone_name') }}</label>
                    <input class="form-control {{ $errors->has('zone_name') ? 'is-invalid' : '' }}" type="text" name="zone_name" id="zone_name" value="{{ old('zone_name', '') }}" required>
                    @if($errors->has('zone_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('zone_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.brand.fields.zone_name_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="latitude">{{ trans('cruds.brand.fields.latitude') }}</label>
                    <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="number" name="latitude" id="latitude" value="{{ old('latitude', '') }}" step="0.01" required>
                    @if($errors->has('latitude'))
                        <div class="invalid-feedback">
                            {{ $errors->first('latitude') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.brand.fields.latitude_helper') }}</span>
                </div>
                <div class="form-group col-md-3">
                    <label class="required" for="longitude">{{ trans('cruds.brand.fields.longitude') }}</label>
                    <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="number" name="longitude" id="longitude" value="{{ old('longitude', '') }}" step="0.01" required>
                    @if($errors->has('longitude'))
                        <div class="invalid-feedback">
                            {{ $errors->first('longitude') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.brand.fields.longitude_helper') }}</span>
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
    url: '{{ route('company.brands.storeMedia') }}',
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
    success: function (file, response) {
      $('form').find('input[name="photo"]').remove()
      $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photo"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($brand) && $brand->photo)
      var file = {!! json_encode($brand->photo) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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