@extends('layouts.admin')
@section('content')
@can('specialization_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.specializations.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.specialization.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.specialization.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Specialization">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.specialization.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialization.fields.name_ar') }}
                        </th>
                        <th>
                            {{ trans('cruds.specialization.fields.name_en') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($specializations as $key => $specialization)
                        <tr data-entry-id="{{ $specialization->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $specialization->id ?? '' }}
                            </td>
                            <td>
                                {{ $specialization->name_ar ?? '' }}
                            </td>
                            <td>
                                {{ $specialization->name_en ?? '' }}
                            </td>
                            <td> 
                                @can('specialization_show')
                                    <a href="{{ route('admin.specializations.show', $specialization->id) }}" class="btn btn-outline-info btn-pill action-buttons-view" >
                                        <i  class="fas fa-eye actions-custom-i"></i>
                                    </a>
                                @endcan

                                @can('specialization_edit')
                                    <a  href="{{ route('admin.specializations.edit', $specialization->id) }}" class="btn btn-outline-success btn-pill action-buttons-edit">
                                        <i  class="fa fa-edit actions-custom-i"></i> 
                                    </a>
                                @endcan

                                @can('specialization_delete')
                                    <?php $route = route('admin.specializations.destroy', $specialization->id); ?>
                                    <a  href="#" onclick="deleteConfirmation('{{$route}}')" class="btn btn-outline-danger btn-pill action-buttons-delete">
                                        <i  class="fa fa-trash actions-custom-i"></i>
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
@can('specialization_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.specializations.massDestroy') }}",
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
    pageLength: 10,
  });
  let table = $('.datatable-Specialization:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection