<div class="form-group"> 
    <div class="row">
        <div class="col-md-6"> 
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
                            {{ trans('cruds.event.fields.photo') }}
                        </th>
                        <td>
                            @if ($event->photo)
                                <a href="{{ $event->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $event->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr> 
                </tbody>
            </table>
        </div>
        <div class="col-md-6"> 
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.company') }}
                        </th>
                        <td>
                            {{ $event->company->user->name ?? '' }}
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
                            @foreach ($event->available_gates as $key => $available_gates)
                                <span class="badge badge-warning text-white">{{ $available_gates->gate }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.specializations') }}
                        </th>
                        <td>
                            @foreach ($event->specializations as $key => $specializations)
                                <span class="badge badge-primary">{{ $specializations->name_ar }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.cawaders') }}
                        </th>
                        <td>
                            @foreach ($event->cawaders as $key => $cader)
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
                                if ($event->status == 'active') {
                                    $event_status = 'success';
                                } elseif ($event->status == 'pending') {
                                    $event_status = 'info';
                                } elseif ($event->status == 'closed') {
                                    $event_status = 'warning';
                                } elseif ($event->status == 'refused') {
                                    $event_status = 'danger';
                                } else {
                                    $event_status = 'dark';
                                }
                            @endphp

                            <span
                                class="badge badge-{{ $event_status }}">{{ trans('global.events_status.' . $event->status) ?? '' }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> 
</div>
