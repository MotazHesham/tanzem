@extends('layouts.admin')
@section('content')
@can('said_about_tanzem_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.said-about-tanzems.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.saidAboutTanzem.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.saidAboutTanzem.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-SaidAboutTanzem">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.saidAboutTanzem.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.saidAboutTanzem.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.saidAboutTanzem.fields.job_position') }}
                        </th>
                        <th>
                            {{ trans('cruds.saidAboutTanzem.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.saidAboutTanzem.fields.text_1') }}
                        </th>
                        <th>
                            {{ trans('cruds.saidAboutTanzem.fields.text_2') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($saidAboutTanzems as $key => $saidAboutTanzem)
                        <tr data-entry-id="{{ $saidAboutTanzem->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $saidAboutTanzem->id ?? '' }}
                            </td>
                            <td>
                                {{ $saidAboutTanzem->name ?? '' }}
                            </td>
                            <td>
                                {{ $saidAboutTanzem->job_position ?? '' }}
                            </td>
                            <td>
                                @if($saidAboutTanzem->photo)
                                    <a href="{{ $saidAboutTanzem->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $saidAboutTanzem->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $saidAboutTanzem->text_1 ?? '' }}
                            </td>
                            <td>
                                {{ $saidAboutTanzem->text_2 ?? '' }}
                            </td>
                            <td> 
                                @can('said_about_tanzem_show')
                                    <a href="{{ route('admin.said-about-tanzems.show', $saidAboutTanzem->id) }}" class="btn btn-outline-info btn-pill action-buttons-view" >
                                        <i  class="fas fa-eye actions-custom-i"></i>
                                    </a>
                                @endcan

                                @can('said_about_tanzem_edit')
                                    <a  href="{{ route('admin.said-about-tanzems.edit', $saidAboutTanzem->id) }}" class="btn btn-outline-success btn-pill action-buttons-edit">
                                        <i  class="fa fa-edit actions-custom-i"></i> 
                                    </a>
                                @endcan

                                @can('said_about_tanzem_delete')
                                    <?php $route = route('admin.said-about-tanzems.destroy', $saidAboutTanzem->id); ?>
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
@can('said_about_tanzem_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.said-about-tanzems.massDestroy') }}",
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
  let table = $('.datatable-SaidAboutTanzem:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection