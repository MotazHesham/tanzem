@extends('layouts.company')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                {{ trans('global.show') }} {{ trans('cruds.event.title') }}
            </div>

            <div class="card-body">
                <div class="form-group">
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('company.events.index') }}">
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
                                    {{ trans('cruds.event.date') }}
                                </th>
                                <td>
                                    <span class="badge badge-dark">{{ $event->start_date }}</span>
                                    <span class="badge badge-dark">{{ $event->end_date }}</span>
                                </td>
                            </tr> 
                            <tr>
                                <th>
                                    {{ trans('cruds.event.time') }}
                                </th>
                                <td>
                                    <span class="badge bg-light">{{ $event->start_time }}</span>
                                    <span class="badge bg-light">{{ $event->end_time }}</span>
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
                                    {{ trans('cruds.event.fields.client') }}
                                </th>
                                <td>
                                    {{ $event->client->user->name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.government') }}
                                </th>
                                <td>
                                    {{ $event->government->user->name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.available_gates') }}
                                </th>
                                <td>
                                    @foreach($event->available_gates as $key => $available_gates)
                                        <span class="badge badge-warning text-white">{{ $available_gates->gate }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.specializations') }}
                                </th>
                                <td>
                                    @foreach($event->specializations as $key => $specializations)
                                        <span class="badge badge-primary">{{ $specializations->name_ar }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.cawaders') }}
                                </th>
                                <td>
                                    @foreach($event->cawaders as $key => $cader)
                                        <span class="badge badge-info">{{ $cader->user->name ?? '' }}</span>
                                    @endforeach
                                </td>
                            </tr> 
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.cost') }}
                                </th>
                                <td>
                                    {{ $event->cost }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.event.fields.status') }}
                                </th>
                                <td>
                                    @php
                                        if($event->status == 'active'){
                                            $event_status = 'success';
                                        }elseif($event->status == 'pending'){
                                            $event_status = 'info';
                                        }elseif($event->status == 'closed'){
                                            $event_status = 'warning';
                                        }elseif($event->status == 'refused'){
                                            $event_status = 'danger';
                                        }else{
                                            $event_status = 'dark';
                                        }
                                    @endphp
                                    
                                    <span class="badge badge-{{$event_status}}">{{ trans('global.events_status.'.$event->status) ?? '' }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('company.events.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                {{ trans('global.relatedData') }}
            </div>
            <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#event_brands" role="tab" data-toggle="tab">
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
                <div class="tab-pane active" role="tabpanel" id="event_brands">
                    @includeIf('company.events.relationships.eventBrands', ['brands' => $event->eventBrands])
                </div>
                <div class="tab-pane" role="tabpanel" id="events_visitors">
                    @includeIf('company.events.relationships.eventsVisitors', ['visitors' => $event->eventsVisitors])
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection