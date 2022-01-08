@extends('layouts.client')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.news.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('client.news.update', [$news->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required" for="title">{{ trans('cruds.news.fields.title') }}</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                            name="title" id="title" value="{{ old('title', $news->title) }}" required>
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.news.fields.title_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required"
                            for="short_description">{{ trans('cruds.news.fields.short_description') }}</label>
                        <input class="form-control {{ $errors->has('short_description') ? 'is-invalid' : '' }}"
                            type="text" name="short_description" id="short_description"
                            value="{{ old('short_description', $news->short_description) }}" required>
                        @if ($errors->has('short_description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('short_description') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.news.fields.short_description_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required"
                            for="long_description">{{ trans('cruds.news.fields.long_description') }}</label>
                        <textarea class="form-control {{ $errors->has('long_description') ? 'is-invalid' : '' }}"
                            name="long_description" id="long_description"
                            required>{{ old('long_description', $news->long_description) }}</textarea>
                        @if ($errors->has('long_description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('long_description') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.news.fields.long_description_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required" for="photo">{{ trans('cruds.news.fields.photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}"
                            id="photo-dropzone">
                        </div>
                        @if ($errors->has('photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.news.fields.photo_helper') }}</span>
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
            url: '{{ route('client.news.storeMedia') }}',
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
                @if (isset($news) && $news->photo)
                    var file = {!! json_encode($news->photo) !!}
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
