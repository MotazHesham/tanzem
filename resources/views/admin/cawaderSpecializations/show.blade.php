@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cawaderSpecialization.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cawader-specializations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cawaderSpecialization.fields.id') }}
                        </th>
                        <td>
                            {{ $cawaderSpecialization->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cawaderSpecialization.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $cawaderSpecialization->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cawaderSpecialization.fields.name_en') }}
                        </th>
                        <td>
                            {{ $cawaderSpecialization->name_en }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cawader-specializations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection