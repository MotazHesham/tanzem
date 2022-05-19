@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.gate.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.gates.update", [$gate->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <input type="hidden" name="latitude" id="latitude" value="{{ $gate->latitude }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ $gate->longitude }}">
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="required" for="gate">{{ trans('cruds.gate.fields.gate') }}</label>
                    <input class="form-control {{ $errors->has('gate') ? 'is-invalid' : '' }}" type="number" name="gate" id="gate" value="{{ old('gate', $gate->gate) }}" step="1" required>
                    @if($errors->has('gate'))
                        <div class="invalid-feedback">
                            {{ $errors->first('gate') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.gate.fields.gate_helper') }}</span>
                </div>

                <div class="form-group col-md-4">
                    <label class="required" for="event_id">{{ trans('cruds.brand.fields.event') }}</label>
                    <select class="form-control select2 {{ $errors->has('event') ? 'is-invalid' : '' }}"
                        name="event_id" id="event_id" required>
                        @foreach ($events as $id => $entry)
                            <option value="{{ $id }}"
                                {{ (old('event_id') ? old('event_id') : $gate->event->id ?? '') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('event'))
                        <div class="invalid-feedback">
                            {{ $errors->first('event') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.brand.fields.event_helper') }}</span>
                </div>

                <div class="form-group col-md-4">
                    <label class="required" for="zone_name">{{ trans('cruds.brand.fields.zone_name') }}</label>
                    <input class="form-control {{ $errors->has('zone_name') ? 'is-invalid' : '' }}" type="text"
                        name="zone_name" id="zone_name" value="{{ old('zone_name', $gate->zone_name) }}" required>
                    @if ($errors->has('zone_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('zone_name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.brand.fields.zone_name_helper') }}</span>
                </div>
                <div class="form-group col-md-6">

                    <label for="photo">{{ trans('cruds.brand.fields.photo') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}"
                        id="photo-dropzone">
                    </div>
                    @if ($errors->has('photo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('photo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.brand.fields.photo_helper') }}</span>

                    <label for="description">{{ trans('cruds.brand.fields.description') }}</label>
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                        name="description" id="description">{{ old('description', $gate->description) }}</textarea>
                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.brand.fields.description_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <input
                        style="width: 300px"
                        id="pac-input"
                        class="form-control"
                        type="text"
                        placeholder="Search Box"
                    />
                    <div id="map3" class="m-b30 align-self-stretch" style="width: 100%; height: 400px"></div>
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
@include('map_scripts.gates.edit')
<script>
    Dropzone.options.photoDropzone = {
    url: '{{ route('admin.gates.storeMedia') }}',
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
@if(isset($gate) && $gate->photo)
      var file = {!! json_encode($gate->photo) !!}
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
