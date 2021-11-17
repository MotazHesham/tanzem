@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.setting.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.settings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.id') }}
                        </th>
                        <td>
                            {{ $setting->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.address') }}
                        </th>
                        <td>
                            {{ $setting->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.phone_1') }}
                        </th>
                        <td>
                            {{ $setting->phone_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.phone_2') }}
                        </th>
                        <td>
                            {{ $setting->phone_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.email_1') }}
                        </th>
                        <td>
                            {{ $setting->email_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.email_2') }}
                        </th>
                        <td>
                            {{ $setting->email_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.facebook') }}
                        </th>
                        <td>
                            {{ $setting->facebook }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.gmail') }}
                        </th>
                        <td>
                            {{ $setting->gmail }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.linkedin') }}
                        </th>
                        <td>
                            {{ $setting->linkedin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.instagram') }}
                        </th>
                        <td>
                            {{ $setting->instagram }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.twitter') }}
                        </th>
                        <td>
                            {{ $setting->twitter }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.latitude') }}
                        </th>
                        <td>
                            {{ $setting->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.longitude') }}
                        </th>
                        <td>
                            {{ $setting->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.home_text_1') }}
                        </th>
                        <td>
                            {{ $setting->home_text_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.home_text_2') }}
                        </th>
                        <td>
                            {{ $setting->home_text_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.about_us') }}
                        </th>
                        <td>
                            {{ $setting->about_us }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.caders_text') }}
                        </th>
                        <td>
                            {{ $setting->caders_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.events_text') }}
                        </th>
                        <td>
                            {{ $setting->events_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.news_text') }}
                        </th>
                        <td>
                            {{ $setting->news_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.how_we_work_header') }}
                        </th>
                        <td>
                            {{ $setting->how_we_work_header }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.how_we_work_1') }}
                        </th>
                        <td>
                            {{ $setting->how_we_work_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.how_we_work_2') }}
                        </th>
                        <td>
                            {{ $setting->how_we_work_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.how_we_work_3') }}
                        </th>
                        <td>
                            {{ $setting->how_we_work_3 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.said_about_tanzem') }}
                        </th>
                        <td>
                            {{ $setting->said_about_tanzem }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.organizers_text') }}
                        </th>
                        <td>
                            {{ $setting->organizers_text }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.setting.fields.contact_us_text') }}
                        </th>
                        <td>
                            {{ $setting->contact_us_text }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.settings.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection