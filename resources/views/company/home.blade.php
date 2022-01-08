@extends('layouts.company')
@section('content') 

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
                        <div class="col-md-4">  
                            <div class="card text-white bg-info" style="position: relative">
                                <div style="position: absolute; left:0 ">
                                    <i style="font-size: 91px;color:#082a482e" class="fa-fw fas fa-camera-retro c-sidebar-nav-icons"></i>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="text-value-lg">{{ $settings1['chart_title'] }}</div>
                                    <div style="font-size: 20px">{{ number_format($settings1['total_number']) }} </div>
                                    <br>
                                </div>
                            </div>
                            <div class="card text-white bg-success" style="position: relative">
                                <div style="position: absolute; left:0 ">
                                    <i style="font-size: 91px;color:#082a482e" class="fa-fw far fa-newspaper c-sidebar-nav-icons"></i>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="text-value-lg">{{ $settings2['chart_title'] }}</div>
                                    <div style="font-size: 20px">{{ number_format($settings2['total_number']) }} </div>
                                    <br>
                                </div>
                            </div>
                            <div class="card text-white bg-danger" style="position: relative">
                                <div style="position: absolute; left:0 ">
                                    <i style="font-size: 91px;color:#082a482e" class="fa-fw far fa-user c-sidebar-nav-icons"></i>
                                </div>
                                <div class="card-body pb-0">
                                    <div class="text-value-lg">{{ $settings3['chart_title'] }}</div>
                                    <div style="font-size: 20px">{{ number_format($settings3['total_number']) }} </div>
                                    <br>
                                </div>
                            </div> 
                        </div> 
                        <div class="col-md-1"> 
                        </div> 
                        <div class="col-md-7"> 
                            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

                            <div id='calendar'></div>
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
@stop