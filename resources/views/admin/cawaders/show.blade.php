@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.cawader.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cawaders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.id') }}
                        </th>
                        <td>
                            {{ $cawader->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.dob') }}
                        </th>
                        <td>
                            {{ $cawader->dob }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.city') }}
                        </th>
                        <td>
                            {{ $cawader->city->name_ar ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.degree') }}
                        </th>
                        <td>
                            {{ App\Models\Cawader::DEGREE_SELECT[$cawader->degree] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.specialization') }}
                        </th>
                        <td>
                            @foreach($cawader->specializations as $key => $specialization)
                                <span class="label label-info">{{ $specialization->name_ar }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.working_hours') }}
                        </th>
                        <td>
                            {{ $cawader->working_hours }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.cawader.fields.identity_number') }}
                        </th>
                        <td>
                            {{ $cawader->identity_number }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cawaders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection