@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.saidAboutTanzem.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.said-about-tanzems.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.saidAboutTanzem.fields.id') }}
                        </th>
                        <td>
                            {{ $saidAboutTanzem->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.saidAboutTanzem.fields.name') }}
                        </th>
                        <td>
                            {{ $saidAboutTanzem->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.saidAboutTanzem.fields.job_position') }}
                        </th>
                        <td>
                            {{ $saidAboutTanzem->job_position }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.saidAboutTanzem.fields.photo') }}
                        </th>
                        <td>
                            @if($saidAboutTanzem->photo)
                                <a href="{{ $saidAboutTanzem->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $saidAboutTanzem->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.saidAboutTanzem.fields.text_1') }}
                        </th>
                        <td>
                            {{ $saidAboutTanzem->text_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.saidAboutTanzem.fields.text_2') }}
                        </th>
                        <td>
                            {{ $saidAboutTanzem->text_2 }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.said-about-tanzems.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection