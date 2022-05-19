@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.gate.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.gate.fields.id') }}
                        </th>
                        <td>
                            {{ $gate->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gate.fields.gate') }}
                        </th>
                        <td>
                            {{ $gate->gate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gate.fields.event') }}
                        </th>
                        <td>
                            {{ $gate->event->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gate.fields.photo') }}
                        </th>
                        <td>
                            @if($gate->photo)
                                <a href="{{ $gate->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $gate->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gate.fields.description') }}
                        </th>
                        <td>
                            {{ $gate->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gate.fields.zone_name') }}
                        </th>
                        <td>
                            {{ $gate->zone_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gate.fields.latitude') }}
                        </th>
                        <td>
                            {{ $gate->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.gate.fields.longitude') }}
                        </th>
                        <td>
                            {{ $gate->longitude }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.gates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection