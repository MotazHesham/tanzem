@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.saidAboutTanzem.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.said-about-tanzems.update", [$saidAboutTanzem->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.saidAboutTanzem.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $saidAboutTanzem->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.saidAboutTanzem.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="job_position">{{ trans('cruds.saidAboutTanzem.fields.job_position') }}</label>
                <input class="form-control {{ $errors->has('job_position') ? 'is-invalid' : '' }}" type="text" name="job_position" id="job_position" value="{{ old('job_position', $saidAboutTanzem->job_position) }}" required>
                @if($errors->has('job_position'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job_position') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.saidAboutTanzem.fields.job_position_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="photo">{{ trans('cruds.saidAboutTanzem.fields.photo') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
                </div>
                @if($errors->has('photo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.saidAboutTanzem.fields.photo_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="text_1">{{ trans('cruds.saidAboutTanzem.fields.text_1') }}</label>
                <input class="form-control {{ $errors->has('text_1') ? 'is-invalid' : '' }}" type="text" name="text_1" id="text_1" value="{{ old('text_1', $saidAboutTanzem->text_1) }}" required>
                @if($errors->has('text_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('text_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.saidAboutTanzem.fields.text_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="text_2">{{ trans('cruds.saidAboutTanzem.fields.text_2') }}</label>
                <textarea class="form-control {{ $errors->has('text_2') ? 'is-invalid' : '' }}" name="text_2" id="text_2" required>{{ old('text_2', $saidAboutTanzem->text_2) }}</textarea>
                @if($errors->has('text_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('text_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.saidAboutTanzem.fields.text_2_helper') }}</span>
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
    url: '{{ route('admin.said-about-tanzems.storeMedia') }}',
    maxFilesize: 6, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 6,
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
@if(isset($saidAboutTanzem) && $saidAboutTanzem->photo)
      var file = {!! json_encode($saidAboutTanzem->photo) !!}
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