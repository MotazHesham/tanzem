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
            <div class="form-group">
                <label class="required" for="gate">{{ trans('cruds.gate.fields.gate') }}</label>
                <input class="form-control {{ $errors->has('gate') ? 'is-invalid' : '' }}" type="number" name="gate" id="gate" value="{{ old('gate', $gate->gate) }}" step="1" required>
                @if($errors->has('gate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.gate.fields.gate_helper') }}</span>
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