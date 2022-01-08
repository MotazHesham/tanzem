<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('client.brands.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.brand.title_singular') }}
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.brand.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-eventBrands">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.brand.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.brand.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.brand.fields.event') }}
                        </th>
                        <th>
                            {{ trans('cruds.brand.fields.zone_name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $key => $brand)
                        <tr data-entry-id="{{ $brand->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $brand->id ?? '' }}
                            </td>
                            <td>
                                {{ $brand->title ?? '' }}
                            </td>
                            <td>
                                {{ $brand->event->title ?? '' }}
                            </td>
                            <td>
                                {{ $brand->zone_name ?? '' }}
                            </td>
                            <td>
                                <a href="{{ route('client.brands.show', $brand->id) }}"
                                    class="btn btn-outline-info btn-pill action-buttons-view">
                                    <i class="fas fa-eye actions-custom-i"></i>
                                </a>

                                <a href="{{ route('client.brands.edit', $brand->id) }}"
                                    class="btn btn-outline-success btn-pill action-buttons-edit">
                                    <i class="fa fa-edit actions-custom-i"></i>
                                </a>

                                <?php $route = route('client.brands.destroy', $brand->id); ?>
                                <a href="#" onclick="deleteConfirmation('{{ $route }}')"
                                    class="btn btn-outline-danger btn-pill action-buttons-delete">
                                    <i class="fa fa-trash actions-custom-i"></i>
                                </a>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('client.brands.massDestroy') }}",
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
                

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-eventBrands:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
