@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.visitorsFamily.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.visitors-families.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.visitorsFamily.fields.id') }}
                        </th>
                        <td>
                            {{ $visitorsFamily->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.visitorsFamily.fields.visitor') }}
                        </th>
                        <td>
                            {{ $visitorsFamily->visitor->national ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.visitorsFamily.fields.name') }}
                        </th>
                        <td>
                            {{ $visitorsFamily->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.visitorsFamily.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\VisitorsFamily::GENDER_SELECT[$visitorsFamily->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.visitorsFamily.fields.relation') }}
                        </th>
                        <td>
                            {{ $visitorsFamily->relation }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.visitorsFamily.fields.phone') }}
                        </th>
                        <td>
                            {{ $visitorsFamily->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.visitorsFamily.fields.identity') }}
                        </th>
                        <td>
                            {{ $visitorsFamily->identity }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.visitors-families.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection