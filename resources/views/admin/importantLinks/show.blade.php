@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.importantLink.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.important-links.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.importantLink.fields.id') }}
                        </th>
                        <td>
                            {{ $importantLink->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.importantLink.fields.text') }}
                        </th>
                        <td>
                            {{ $importantLink->text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.importantLink.fields.link') }}
                        </th>
                        <td>
                            {{ $importantLink->link }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.important-links.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection