
<input type="hidden" name="latitude" id="latitude" value="{{ $event->latitude }}">
<input type="hidden" name="longitude" id="longitude" value="{{ $event->longitude }}">


<div class="form-group col-md-3">
    <label class="required" for="title">{{ trans('cruds.event.fields.title') }}</label>
    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title"
        value="{{ old('title', $event->title) }}" required>
    @if ($errors->has('title'))
        <div class="invalid-feedback">
            {{ $errors->first('title') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.event.fields.title_helper') }}</span>
</div>
<div class="form-group col-md-3">
    <label for="cost">{{ trans('cruds.event.fields.cost') }}</label>
    <input class="form-control {{ $errors->has('cost') ? 'is-invalid' : '' }}" type="number" name="cost" id="cost"
        value="{{ old('cost', $event->cost) }}" step="0.01">
    @if ($errors->has('cost'))
        <div class="invalid-feedback">
            {{ $errors->first('cost') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.event.fields.cost_helper') }}</span>
</div>
<div class="form-group col-md-3">
    <label class="required" for="start_date">{{ trans('cruds.event.fields.start_date') }}</label>
    <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text"
        name="start_date" id="start_date" value="{{ old('start_date', $event->start_date) }}" required>
    @if ($errors->has('start_date'))
        <div class="invalid-feedback">
            {{ $errors->first('start_date') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.event.fields.start_date_helper') }}</span>
</div>
<div class="form-group col-md-3">
    <label class="required" for="end_date">{{ trans('cruds.event.fields.end_date') }}</label>
    <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date"
        id="end_date" value="{{ old('end_date', $event->end_date) }}" required>
    @if ($errors->has('end_date'))
        <div class="invalid-feedback">
            {{ $errors->first('end_date') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.event.fields.end_date_helper') }}</span>
</div>
<div class="form-group col-md-3">
    <label class="required" for="start_time">{{ trans('cruds.event.fields.start_time') }}</label>
    <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text"
        name="start_time" id="start_time" value="{{ old('start_time', $event->start_time) }}" required>
    @if ($errors->has('start_time'))
        <div class="invalid-feedback">
            {{ $errors->first('start_time') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.event.fields.start_time_helper') }}</span>
</div>
<div class="form-group col-md-3">
    <label class="required" for="end_time">{{ trans('cruds.event.fields.end_time') }}</label>
    <input class="form-control timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text"
        name="end_time" id="end_time" value="{{ old('end_time', $event->end_time) }}" required>
    @if ($errors->has('end_time'))
        <div class="invalid-feedback">
            {{ $errors->first('end_time') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.event.fields.end_time_helper') }}</span>
</div>
<div class="form-group col-md-4">
    <label class="required" for="city_id">{{ trans('cruds.event.fields.city') }}</label>
    <select class="form-control select2 {{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id"
        required>
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
<div class="form-group col-md-4">
    <label class="required" for="address">{{ trans('cruds.event.fields.address') }}</label>
    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address"
        id="address" value="{{ old('address', $event->address) }}" required>
    @if ($errors->has('address'))
        <div class="invalid-feedback">
            {{ $errors->first('address') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.event.fields.address_helper') }}</span>
</div>
<div class="form-group col-md-4">
    <label class="required" for="area">{{ trans('cruds.event.fields.area') }}</label>
    <input class="form-control {{ $errors->has('area') ? 'is-invalid' : '' }}" type="number" step="1" name="area"
        id="area" value="{{ old('area', $event->area) }}" required>
    @if ($errors->has('area'))
        <div class="invalid-feedback">
            {{ $errors->first('area') }}
        </div>
    @endif
    <span class="help-block" style="font-size: 10px">{{ trans('cruds.event.fields.area_helper') }}</span>
</div>
<div class="form-group col-md-6">
    <label class="required" for="specializations">{{ trans('cruds.event.fields.specializations') }}</label>
    <div style="padding-bottom: 4px">
        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
        <span class="btn btn-info btn-xs deselect-all"
            style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
    </div>
    <select class="form-control select2 {{ $errors->has('specializations') ? 'is-invalid' : '' }}"
        name="specializations[]" id="specializations" multiple required>
        @foreach ($specializations as $id => $specialization)
            <option value="{{ $id }}"
                {{ in_array($id, old('specializations', [])) || $event->specializations->contains($id) ? 'selected' : '' }}>
                {{ $specialization }}</option>
        @endforeach
    </select>
    @if ($errors->has('specializations'))
        <div class="invalid-feedback">
            {{ $errors->first('specializations') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.event.fields.specializations_helper') }}</span>
</div>
<div class="form-group col-md-6">
    <label class="required" for="available_gates">{{ trans('cruds.event.fields.available_gates') }}</label>
    <div style="padding-bottom: 4px">
        <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
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
    <div class="row">
        <div class="col-md-6">
            <label class="required" for="photo">{{ trans('cruds.event.fields.photo') }}</label>
            <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
            </div>
            @if ($errors->has('photo'))
                <div class="invalid-feedback">
                    {{ $errors->first('photo') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.event.fields.photo_helper') }}</span>
        </div>
        <div class="col-md-6">
            <label for="description">{{ trans('cruds.event.fields.description') }}</label>
            <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description"
                id="description">{{ old('description', $event->description) }}</textarea>
            @if ($errors->has('description'))
                <div class="invalid-feedback">
                    {{ $errors->first('description') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
        </div>
        <div class="form-group col-md-12">
            <div class="partials-scrollable mt-3">
                @include('admin.events.partials.caders')
            </div>
        </div>
    </div>
</div>
<div class="form-group col-md-6">
    <input style="width: 300px" id="pac-input" class="form-control" type="text" placeholder="Search Box" />
    <div id="map3" class="m-b30 align-self-stretch" style="width: 100%; height: 400px"></div>
</div>
