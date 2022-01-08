@extends('layouts.company')
@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                {{ trans('global.show') }} {{ trans('cruds.visitor.title') }}
            </div>
        
            <div class="card-body">
                <div class="form-group">
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('company.visitors.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.visitor.fields.id') }}
                                </th>
                                <td>
                                    {{ $visitor->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.name') }}
                                </th>
                                <td>
                                    {{ $visitor->user->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email') }}
                                </th>
                                <td>
                                    {{ $visitor->user->email }}
                                </td>
                            </tr> 
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.phone') }}
                                </th>
                                <td>
                                    {{ $visitor->user->phone }}
                                </td>
                            </tr> 
                            <tr>
                                <th>
                                    {{ trans('cruds.visitor.fields.national') }}
                                </th>
                                <td>
                                    {{ $visitor->national }}
                                </td>
                            </tr> 
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.photo') }}
                                </th>
                                <td>
                                    @if($visitor->user && $visitor->user->photo)
                                        <a href="{{ $visitor->user->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $visitor->user->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('company.visitors.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                {{ trans('global.relatedData') }}
            </div>
            <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#visitor_visitors_families" role="tab" data-toggle="tab">
                        {{ trans('cruds.visitorsFamily.title') }}
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="visitor_visitors_families">
                    @includeIf('company.visitors.relationships.visitorVisitorsFamilies', ['visitorsFamilies' => $visitor->visitorVisitorsFamilies])
                </div>
            </div>
        </div>
    </div>
</div>


@endsection