@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.event.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.id') }}
                        </th>
                        <td>
                            {{ $event->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.title') }}
                        </th>
                        <td>
                            {{ $event->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.description') }}
                        </th>
                        <td>
                            {{ $event->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.start_date') }}
                        </th>
                        <td>
                            {{ $event->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.end_date') }}
                        </th>
                        <td>
                            {{ $event->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.start_time') }}
                        </th>
                        <td>
                            {{ $event->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.end_time') }}
                        </th>
                        <td>
                            {{ $event->end_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.city') }}
                        </th>
                        <td>
                            {{ $event->city->name_ar ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.address') }}
                        </th>
                        <td>
                            {{ $event->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.latitude') }}
                        </th>
                        <td>
                            {{ $event->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.longitude') }}
                        </th>
                        <td>
                            {{ $event->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.photo') }}
                        </th>
                        <td>
                            @if($event->photo)
                                <a href="{{ $event->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $event->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.company') }}
                        </th>
                        <td>
                            {{ $event->company->commerical_num ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.available_gates') }}
                        </th>
                        <td>
                            @foreach($event->available_gates as $key => $available_gates)
                                <span class="label label-info">{{ $available_gates->gate }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#event_brands" role="tab" data-toggle="tab">
                {{ trans('cruds.brand.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#events_visitors" role="tab" data-toggle="tab">
                {{ trans('cruds.visitor.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="event_brands">
            @includeIf('admin.events.relationships.eventBrands', ['brands' => $event->eventBrands])
        </div>
        <div class="tab-pane" role="tabpanel" id="events_visitors">
            @includeIf('admin.events.relationships.eventsVisitors', ['visitors' => $event->eventsVisitors])
        </div>
    </div>
</div>

@endsection