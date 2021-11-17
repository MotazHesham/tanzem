@extends('layouts.admin')
@section('content')
@can('visitors_family_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.visitors-families.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.visitorsFamily.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.visitorsFamily.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-VisitorsFamily">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.visitorsFamily.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.visitorsFamily.fields.visitor') }}
                        </th>
                        <th>
                            {{ trans('cruds.visitorsFamily.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.visitorsFamily.fields.gender') }}
                        </th>
                        <th>
                            {{ trans('cruds.visitorsFamily.fields.relation') }}
                        </th>
                        <th>
                            {{ trans('cruds.visitorsFamily.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.visitorsFamily.fields.identity') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visitorsFamilies as $key => $visitorsFamily)
                        <tr data-entry-id="{{ $visitorsFamily->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $visitorsFamily->id ?? '' }}
                            </td>
                            <td>
                                {{ $visitorsFamily->visitor->national ?? '' }}
                            </td>
                            <td>
                                {{ $visitorsFamily->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\VisitorsFamily::GENDER_SELECT[$visitorsFamily->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $visitorsFamily->relation ?? '' }}
                            </td>
                            <td>
                                {{ $visitorsFamily->phone ?? '' }}
                            </td>
                            <td>
                                {{ $visitorsFamily->identity ?? '' }}
                            </td>
                            <td>

                                @can('visitors_family_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.visitors-families.edit', $visitorsFamily->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('visitors_family_delete')
                                    <form action="{{ route('admin.visitors-families.destroy', $visitorsFamily->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
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
@can('visitors_family_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.visitors-families.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-VisitorsFamily:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection