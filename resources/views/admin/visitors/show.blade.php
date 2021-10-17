@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.visitor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.visitors.index') }}">
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
                            {{ trans('cruds.visitor.fields.user') }}
                        </th>
                        <td>
                            {{ $visitor->user->email ?? '' }}
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
                            {{ trans('cruds.visitor.fields.events') }}
                        </th>
                        <td>
                            @foreach($visitor->events as $key => $events)
                                <span class="label label-info">{{ $events->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.visitor.fields.brands') }}
                        </th>
                        <td>
                            @foreach($visitor->brands as $key => $brands)
                                <span class="label label-info">{{ $brands->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.visitors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection