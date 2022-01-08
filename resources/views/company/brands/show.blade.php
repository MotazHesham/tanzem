@extends('layouts.company')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.brand.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('company.brands.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.id') }}
                        </th>
                        <td>
                            {{ $brand->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.title') }}
                        </th>
                        <td>
                            {{ $brand->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.description') }}
                        </th>
                        <td>
                            {{ $brand->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.photo') }}
                        </th>
                        <td>
                            @if($brand->photo)
                                <a href="{{ $brand->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $brand->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.event') }}
                        </th>
                        <td>
                            {{ $brand->event->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.zone_name') }}
                        </th>
                        <td>
                            {{ $brand->zone_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.latitude') }}
                        </th>
                        <td>
                            {{ $brand->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.longitude') }}
                        </th>
                        <td>
                            {{ $brand->longitude }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('company.brands.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

{{-- <div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#brands_visitors" role="tab" data-toggle="tab">
                {{ trans('cruds.visitor.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="brands_visitors">
            @includeIf('company.brands.relationships.brandsVisitors', ['visitors' => $brand->brandsVisitors])
        </div>
    </div>
</div> --}}

@endsection