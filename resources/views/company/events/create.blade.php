@extends('layouts.company')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.event.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('company.events.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="status" value="pending">
                <input type="hidden" name="company_id" value="{{ $company->id }}">

                <div class="row">

                    <div class="form-group col-md-3">
                        <label class="required" for="client_id">{{ trans('cruds.event.fields.client') }}</label>
                        <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}"
                            name="client_id" id="client_id" required>
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
                    <div class="form-group col-md-3">
                        <label class="required"
                            for="government_id">{{ trans('cruds.event.fields.government') }}</label>
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
            url: '{{ route('company.events.storeMedia') }}',
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
@endsection
