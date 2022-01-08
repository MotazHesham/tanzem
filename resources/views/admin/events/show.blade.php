@extends('layouts.admin')

@section('styles')
    <style>
        .nav-tabs .nav-item .nav-link {
            padding: 12px;
            color: #5D6D7E
        }
    </style>
@endsection

@section('content')


    <!-- Modal attendance cader -->
    <div class="modal fade bd-example-modal-lg" id="attendance_modal" tabindex="1" role="dialog" aria-labelledby="attendance_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="attendance_modalLabel">{{trans('cruds.event.others.attendance_in_event')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">  
                </div> 
            </div>
        </div>
    </div>

    <!-- Modal cader_break cader -->
    <div class="modal fade bd-example-modal-lg" id="cader_break_modal" tabindex="1" role="dialog" aria-labelledby="cader_break_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cader_break_modalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">  
                </div> 
            </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.event.title') }}
        </div>

        <div class="card-body">
            
            <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-map-tab" data-toggle="pill" href="#pills-map" role="tab" aria-controls="pills-map" aria-selected="false">
                        <i class="fas fa-map-marked-alt"></i>
                        {{ trans('cruds.event.others.map') }}
                    </a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link " id="pills-info-tab" data-toggle="pill" href="#pills-info" role="tab" aria-controls="pills-info" aria-selected="true">
                        <i class="fas fa-info-circle"></i>
                        {{ trans('cruds.event.others.info') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-services-tab" data-toggle="pill" href="#pills-services" role="tab" aria-controls="pills-services" aria-selected="false">
                        <i class="fas fa-tasks"></i>
                        {{ trans('global.relatedData') }}
                    </a>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-map" role="tabpanel" aria-labelledby="pills-map-tab"> 
                    <div class="row">
                        <div class="col-md-3">   
                            <div id="caders_in_map" class="partials-scrollable" style="max-height: 605px">
                                @includeIf('admin.events.partials.caders_map', ['event' => $event])
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">  
                                <div id="map3"  style="width: 100%; height: 600px"></div>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="tab-pane fade" id="pills-info" role="tabpanel" aria-labelledby="pills-info-tab">
                    @includeIf('admin.events.partials.info', ['event' => $event])
                </div>
                <div class="tab-pane fade" id="pills-services" role="tabpanel" aria-labelledby="pills-services-tab">
                    @includeIf('admin.events.partials.related_data', ['event' => $event])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@parent  

    @include('map_scripts.events.show')

@endsection