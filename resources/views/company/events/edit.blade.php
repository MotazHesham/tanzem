@extends('layouts.company')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.event.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('company.events.update', [$event->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="company_id" value="{{ $event->company->id }}">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="required" for="client_id">{{ trans('cruds.event.fields.client') }}</label>
                        <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id" id="client_id" required>
                            @foreach($clients as $id => $entry)
                                <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $event->client->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('client'))
                            <div class="invalid-feedback">
                                {{ $errors->first('client') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.client_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required" for="government_id">{{ trans('cruds.event.fields.government') }}</label>
                        <select class="form-control select2 {{ $errors->has('government') ? 'is-invalid' : '' }}" name="government_id" id="government_id" required>
                            @foreach($governments as $id => $entry)
                                <option value="{{ $id }}" {{ (old('government_id') ? old('government_id') : $event->government->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('government'))
                            <div class="invalid-feedback">
                                {{ $errors->first('government') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.government_helper') }}</span>
                    </div> 
                    <div class="form-group col-md-3">
                        <label class="required" for="title">{{ trans('cruds.event.fields.title') }}</label>
                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                            name="title" id="title" value="{{ old('title', $event->title) }}" required>
                        @if ($errors->has('title'))
                            <div class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.title_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cost">{{ trans('cruds.event.fields.cost') }}</label>
                        <input class="form-control {{ $errors->has('cost') ? 'is-invalid' : '' }}" type="number" name="cost" id="cost" value="{{ old('cost', $event->cost) }}" step="0.01">
                        @if($errors->has('cost'))
                            <div class="invalid-feedback">
                                {{ $errors->first('cost') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.cost_helper') }}</span>
                    </div> 
                    <div class="form-group col-md-3">
                        <label class="required"
                            for="start_date">{{ trans('cruds.event.fields.start_date') }}</label>
                        <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text"
                            name="start_date" id="start_date" value="{{ old('start_date', $event->start_date) }}"
                            required>
                        @if ($errors->has('start_date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('start_date') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.start_date_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required" for="end_date">{{ trans('cruds.event.fields.end_date') }}</label>
                        <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text"
                            name="end_date" id="end_date" value="{{ old('end_date', $event->end_date) }}" required>
                        @if ($errors->has('end_date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('end_date') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.end_date_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required"
                            for="start_time">{{ trans('cruds.event.fields.start_time') }}</label>
                        <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}"
                            type="text" name="start_time" id="start_time"
                            value="{{ old('start_time', $event->start_time) }}" required>
                        @if ($errors->has('start_time'))
                            <div class="invalid-feedback">
                                {{ $errors->first('start_time') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.start_time_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required" for="end_time">{{ trans('cruds.event.fields.end_time') }}</label>
                        <input class="form-control timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}"
                            type="text" name="end_time" id="end_time" value="{{ old('end_time', $event->end_time) }}"
                            required>
                        @if ($errors->has('end_time'))
                            <div class="invalid-feedback">
                                {{ $errors->first('end_time') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.end_time_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required" for="city_id">{{ trans('cruds.event.fields.city') }}</label>
                        <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}"
                            name="city_id" id="city_id" required>
                            @foreach ($cities as $id => $entry)
                                <option value="{{ $id }}"
                                    {{ (old('city_id') ? old('city_id') : $event->city->id ?? '') == $id ? 'selected' : '' }}>
                                    {{ $entry }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('city'))
                            <div class="invalid-feedback">
                                {{ $errors->first('city') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.city_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required" for="address">{{ trans('cruds.event.fields.address') }}</label>
                        <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text"
                            name="address" id="address" value="{{ old('address', $event->address) }}" required>
                        @if ($errors->has('address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.address_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required" for="latitude">{{ trans('cruds.event.fields.latitude') }}</label>
                        <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="number"
                            name="latitude" id="latitude" value="{{ old('latitude', $event->latitude) }}" step="0.01"
                            required>
                        @if ($errors->has('latitude'))
                            <div class="invalid-feedback">
                                {{ $errors->first('latitude') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.latitude_helper') }}</span>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="required" for="longitude">{{ trans('cruds.event.fields.longitude') }}</label>
                        <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="number"
                            name="longitude" id="longitude" value="{{ old('longitude', $event->longitude) }}" step="0.01"
                            required>
                        @if ($errors->has('longitude'))
                            <div class="invalid-feedback">
                                {{ $errors->first('longitude') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.longitude_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required" for="specializations">{{ trans('cruds.event.fields.specializations') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('specializations') ? 'is-invalid' : '' }}" name="specializations[]" id="specializations" multiple required>
                            @foreach($specializations as $id => $specialization)
                                <option value="{{ $id }}" {{ (in_array($id, old('specializations', [])) || $event->specializations->contains($id)) ? 'selected' : '' }}>{{ $specialization }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('specializations'))
                            <div class="invalid-feedback">
                                {{ $errors->first('specializations') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.specializations_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cawaders">{{ trans('cruds.event.fields.cawaders') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('cawaders') ? 'is-invalid' : '' }}" name="cawaders[]" id="cawaders" multiple>
                            @foreach($cawaders as $id => $cawader)
                                <option value="{{ $id }}" {{ (in_array($id, old('cawaders', [])) || $event->cawaders->contains($id)) ? 'selected' : '' }}>{{ $cawader }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('cawaders'))
                            <div class="invalid-feedback">
                                {{ $errors->first('cawaders') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.cawaders_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required"
                            for="available_gates">{{ trans('cruds.event.fields.available_gates') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all"
                                style="border-radius: 0">{{ trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all"
                                style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                        </div>
                        <select class="form-control select2 {{ $errors->has('available_gates') ? 'is-invalid' : '' }}"
                            name="available_gates[]" id="available_gates" multiple required>
                            @foreach ($available_gates as $id => $available_gate)
                                <option value="{{ $id }}"
                                    {{ in_array($id, old('available_gates', [])) || $event->available_gates->contains($id) ? 'selected' : '' }}>
                                    {{ $available_gate }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('available_gates'))
                            <div class="invalid-feedback">
                                {{ $errors->first('available_gates') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.available_gates_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required" for="photo">{{ trans('cruds.event.fields.photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}"
                            id="photo-dropzone">
                        </div>
                        @if ($errors->has('photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.photo_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="description">{{ trans('cruds.event.fields.description') }}</label>
                        <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            name="description" id="description">{{ old('description', $event->description) }}</textarea>
                        @if ($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
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
