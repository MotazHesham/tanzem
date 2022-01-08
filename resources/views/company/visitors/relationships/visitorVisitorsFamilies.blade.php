@can('visitors_family_create')
    <a class="btn btn-info" style="margin:15px" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        {{ trans('global.create') }} {{ trans('cruds.visitorsFamily.title_singular') }}
    </a> 
    <div class="card"> 
        <div class="collapse" id="collapseExample"> 
            <div class="card-body">
                <form method="POST" action="{{ route('admin.visitors-families.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="visitor_id" value="{{ $visitor->id }}" id="">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label class="required" for="name">{{ trans('cruds.visitorsFamily.fields.name') }}</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                id="name" value="{{ old('name', '') }}" required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.visitorsFamily.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required">{{ trans('cruds.visitorsFamily.fields.gender') }}</label>
                            <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender"
                                id="gender" required>
                                <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>
                                    {{ trans('global.pleaseSelect') }}</option>
                                @foreach (App\Models\VisitorsFamily::GENDER_SELECT as $key => $label)
                                    <option value="{{ $key }}"
                                        {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('gender'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('gender') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.visitorsFamily.fields.gender_helper') }}</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required"
                                for="relation">{{ trans('cruds.visitorsFamily.fields.relation') }}</label>
                            <input class="form-control {{ $errors->has('relation') ? 'is-invalid' : '' }}" type="text"
                                name="relation" id="relation" value="{{ old('relation', '') }}" required>
                            @if ($errors->has('relation'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('relation') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.visitorsFamily.fields.relation_helper') }}</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required"
                                for="phone">{{ trans('cruds.visitorsFamily.fields.phone') }}</label>
                            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text"
                                name="phone" id="phone" value="{{ old('phone', '') }}" required>
                            @if ($errors->has('phone'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('phone') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.visitorsFamily.fields.phone_helper') }}</span>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required"
                                for="identity">{{ trans('cruds.visitorsFamily.fields.identity') }}</label>
                            <input class="form-control {{ $errors->has('identity') ? 'is-invalid' : '' }}" type="text"
                                name="identity" id="identity" value="{{ old('identity', '') }}" required>
                            @if ($errors->has('identity'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('identity') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.visitorsFamily.fields.identity_helper') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endcan

<div class="card mt-4">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('cruds.visitorsFamily.title') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-visitorVisitorsFamilies">
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
                    @foreach ($visitorsFamilies as $key => $visitorsFamily)
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
                                    <a href="{{ route('admin.visitors-families.edit', $visitorsFamily->id) }}"
                                        class="btn btn-outline-success btn-pill action-buttons-edit">
                                        <i class="fa fa-edit actions-custom-i"></i>
                                    </a>
                                @endcan

                                @can('visitors_family_delete')
                                    <?php $route = route('admin.visitors-families.destroy', $visitorsFamily->id); ?>
                                    <a href="#" onclick="deleteConfirmation('{{ $route }}')"
                                        class="btn btn-outline-danger btn-pill action-buttons-delete">
                                        <i class="fa fa-trash actions-custom-i"></i>
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
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-visitorVisitorsFamilies:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
