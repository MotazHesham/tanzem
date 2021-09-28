@extends('layouts.admin')
@section('content')
@can('companies_and_institution_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.companies-and-institutions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.companiesAndInstitution.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.companiesAndInstitution.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-CompaniesAndInstitution">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.commerical_num') }}
                        </th>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.commerical_expiry') }}
                        </th>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.licence_num') }}
                        </th>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.licence_expiry') }}
                        </th>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.companiesAndInstitution.fields.specialization') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companiesAndInstitutions as $key => $companiesAndInstitution)
                        <tr data-entry-id="{{ $companiesAndInstitution->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $companiesAndInstitution->id ?? '' }}
                            </td>
                            <td>
                                {{ $companiesAndInstitution->commerical_num ?? '' }}
                            </td>
                            <td>
                                {{ $companiesAndInstitution->commerical_expiry ?? '' }}
                            </td>
                            <td>
                                {{ $companiesAndInstitution->licence_num ?? '' }}
                            </td>
                            <td>
                                {{ $companiesAndInstitution->licence_expiry ?? '' }}
                            </td>
                            <td>
                                {{ $companiesAndInstitution->user->email ?? '' }}
                            </td>
                            <td>
                                {{ $companiesAndInstitution->specialization->name_ar ?? '' }}
                            </td>
                            <td>
                                @can('companies_and_institution_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.companies-and-institutions.show', $companiesAndInstitution->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('companies_and_institution_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.companies-and-institutions.edit', $companiesAndInstitution->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('companies_and_institution_delete')
                                    <form action="{{ route('admin.companies-and-institutions.destroy', $companiesAndInstitution->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('companies_and_institution_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.companies-and-institutions.massDestroy') }}",
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
  let table = $('.datatable-CompaniesAndInstitution:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection