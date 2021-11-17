@can('visitor_create')
    {{-- <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.visitors.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.visitor.title_singular') }}
            </a>
        </div>
    </div> --}}
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.visitor.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-eventsVisitors">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.visitor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.visitor.fields.user') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitors as $key => $visitor)
                        <tr data-entry-id="{{ $visitor->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $visitor->id ?? '' }}
                            </td>
                            <td>
                                {{ $visitor->user->name ?? '' }}
                            </td>
                            <td>
                                @can('visitor_show')
                                    <a href="{{ route('admin.visitors.show', $visitor->id) }}"
                                        class="btn btn-outline-info btn-pill action-buttons-view">
                                        <i class="fas fa-eye actions-custom-i"></i>
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

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons) 

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-eventsVisitors:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
