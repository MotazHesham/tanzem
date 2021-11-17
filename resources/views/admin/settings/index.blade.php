@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.setting.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Setting">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.phone_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.phone_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.email_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.email_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.facebook') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.gmail') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.linkedin') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.instagram') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.twitter') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.latitude') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.longitude') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.home_text_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.home_text_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.about_us') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.caders_text') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.events_text') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.news_text') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.how_we_work_header') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.how_we_work_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.how_we_work_2') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.how_we_work_3') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.said_about_tanzem') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.organizers_text') }}
                        </th>
                        <th>
                            {{ trans('cruds.setting.fields.contact_us_text') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($settings as $key => $setting)
                        <tr data-entry-id="{{ $setting->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $setting->id ?? '' }}
                            </td>
                            <td>
                                {{ $setting->address ?? '' }}
                            </td>
                            <td>
                                {{ $setting->phone_1 ?? '' }}
                            </td>
                            <td>
                                {{ $setting->phone_2 ?? '' }}
                            </td>
                            <td>
                                {{ $setting->email_1 ?? '' }}
                            </td>
                            <td>
                                {{ $setting->email_2 ?? '' }}
                            </td>
                            <td>
                                {{ $setting->facebook ?? '' }}
                            </td>
                            <td>
                                {{ $setting->gmail ?? '' }}
                            </td>
                            <td>
                                {{ $setting->linkedin ?? '' }}
                            </td>
                            <td>
                                {{ $setting->instagram ?? '' }}
                            </td>
                            <td>
                                {{ $setting->twitter ?? '' }}
                            </td>
                            <td>
                                {{ $setting->latitude ?? '' }}
                            </td>
                            <td>
                                {{ $setting->longitude ?? '' }}
                            </td>
                            <td>
                                {{ $setting->home_text_1 ?? '' }}
                            </td>
                            <td>
                                {{ $setting->home_text_2 ?? '' }}
                            </td>
                            <td>
                                {{ $setting->about_us ?? '' }}
                            </td>
                            <td>
                                {{ $setting->caders_text ?? '' }}
                            </td>
                            <td>
                                {{ $setting->events_text ?? '' }}
                            </td>
                            <td>
                                {{ $setting->news_text ?? '' }}
                            </td>
                            <td>
                                {{ $setting->how_we_work_header ?? '' }}
                            </td>
                            <td>
                                {{ $setting->how_we_work_1 ?? '' }}
                            </td>
                            <td>
                                {{ $setting->how_we_work_2 ?? '' }}
                            </td>
                            <td>
                                {{ $setting->how_we_work_3 ?? '' }}
                            </td>
                            <td>
                                {{ $setting->said_about_tanzem ?? '' }}
                            </td>
                            <td>
                                {{ $setting->organizers_text ?? '' }}
                            </td>
                            <td>
                                {{ $setting->contact_us_text ?? '' }}
                            </td>
                            <td>

                                @can('setting_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.settings.edit', $setting->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan


                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Setting:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection