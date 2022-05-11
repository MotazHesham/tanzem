@extends('layouts.admin')
@section('content')
<head>
    <style>
        .text-value-lg, .text-value-lg a {
                color: #fff;
                font-size: 1.3125rem;
            }
    </style>
</head>
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="{{ $settings1['column_class'] }}">
                            <div class="card text-white bg-info" style="position: relative">
                                <div style="position: absolute; left:0 ">
                                    <i style="font-size: 91px;color:#082a482e" class="fa-fw fas fa-camera-retro c-sidebar-nav-icons"></i>
                                </div>
                                <div class="card-body pb-0">
                                    <a href="{{ route("admin.events.index") }}"><div class="text-value-lg">{{ $settings1['chart_title'] }}</div></a>
                                    <div style="font-size: 20px">{{ number_format($settings1['total_number']) }} </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings2['column_class'] }}">
                            <div class="card text-white bg-success" style="position: relative">
                                <div style="position: absolute; left:0 ">
                                    <i style="font-size: 91px;color:#082a482e" class="fa-fw fas fa-user c-sidebar-nav-icons"></i>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="text-value-lg"><a href="{{ route("admin.cawaders.index") }}">{{ $settings2['chart_title'] }}</a></div>
                                    <div style="font-size: 20px">{{ number_format($settings2['total_number']) }} </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings3['column_class'] }}">
                            <div class="card text-white bg-warning" style="position: relative">
                                <div style="position: absolute; left:0 ">
                                    <i style="font-size: 91px;color:#082a482e" class="fa-fw fas fa-user-friends c-sidebar-nav-icons"></i>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="text-value-lg"><a href="{{ route("admin.visitors.index") }}" >{{ $settings3['chart_title'] }}</a></div>
                                    <div style="font-size: 20px">{{ number_format($settings3['total_number']) }} </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="{{ $settings4['column_class'] }}">
                            <div class="card text-white bg-danger" style="position: relative">
                                <div style="position: absolute; left:0 ">
                                    <i style="font-size: 91px;color:#082a482e" class="fa-fw fas fa-newspaper c-sidebar-nav-icons"></i>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="text-value-lg">  <a href="{{ route("admin.news.index") }}">{{ $settings4['chart_title'] }}</a></div>
                                    <div style="font-size: 20px">{{ number_format($settings4['total_number']) }} </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="{{ $chart5->options['column_class'] }}">
                            <h3 class="text-center">{!! $chart5->options['chart_title'] !!}</h3>
                            {!! $chart5->renderHtml() !!}
                        </div>
                        <div class="col-md-7">
                            <h3 class="text-center">{{ trans('global.dashboard_widgets.Events Start') }}</h3>
                            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

                            <div id='calendar'></div>
                        </div>
                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings7['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings7['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings7['fields'] as $key => $value)
                                            <th>
                                                {{ trans(sprintf('cruds.%s.fields.%s', $settings7['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings7['data'] as $entry)
                                        <tr>
                                            @foreach($settings7['fields'] as $key => $value)
                                                <td>
                                                    @if($value === '')
                                                        {{ $entry->{$key} }}
                                                    @elseif(is_iterable($entry->{$key}))
                                                        @foreach($entry->{$key} as $subEentry)
                                                             <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                        @endforeach
                                                    @else
                                                         <a href="{{ route("admin.governmental-entities.show",$entry->id) }}" >  {{ data_get($entry, $key . '.' . $value) }}</a>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="{{ count($settings7['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings8['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings8['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings8['fields'] as $key => $value)
                                            <th>
                                                {{ trans(sprintf('cruds.%s.fields.%s', $settings8['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings8['data'] as $entry)
                                        <tr>
                                            @foreach($settings8['fields'] as $key => $value)
                                                <td>
                                                    @if($value === '')
                                                        {{ $entry->{$key} }}
                                                    @elseif(is_iterable($entry->{$key}))
                                                        @foreach($entry->{$key} as $subEentry)
                                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                        @endforeach
                                                    @else
                                                        <a href="{{ route("admin.clients.show",$entry->id) }}"> {{ data_get($entry, $key . '.' . $value) }}</a>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="{{ count($settings8['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Widget - latest entries --}}
                        <div class="{{ $settings9['column_class'] }}" style="overflow-x: auto;">
                            <h3>{{ $settings9['chart_title'] }}</h3>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        @foreach($settings9['fields'] as $key => $value)
                                            <th>
                                                {{ trans(sprintf('cruds.%s.fields.%s', $settings9['translation_key'] ?? 'pleaseUpdateWidget', $key)) }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($settings9['data'] as $entry)
                                        <tr>
                                            @foreach($settings9['fields'] as $key => $value)
                                                <td>
                                                    @if($value === '')
                                                        {{ $entry->{$key} }}
                                                    @elseif(is_iterable($entry->{$key}))
                                                        @foreach($entry->{$key} as $subEentry)
                                                            <span class="label label-info">{{ $subEentry->{$value} }}</span>
                                                        @endforeach
                                                    @else
                                                      <a href="{{ route("admin.companies-and-institutions.show",$entry->id) }}"> {{ data_get($entry, $key . '.' . $value) }}</a>
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="{{ count($settings9['fields']) }}">{{ __('No entries found') }}</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart5->renderJs() !!}
<script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function () {
            // page is now ready, initialize the calendar...
            events={!! json_encode($events) !!};
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                events: events,


            })
        });
</script>
@endsection
