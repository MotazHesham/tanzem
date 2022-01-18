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
                                {{ trans('cruds.user.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.phone') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.photo') }}
                            </th>
                            <th>
                                {{ trans('cruds.companiesAndInstitution.fields.specializations') }}
                            </th>
                            <th>
                                {{ trans('cruds.user.fields.approved') }}
                            </th> 
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companiesAndInstitutions as $key => $companiesAndInstitution)
                            <tr data-entry-id="{{ $companiesAndInstitution->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $companiesAndInstitution->id ?? '' }}
                                </td>
                                <td>
                                    {{ $companiesAndInstitution->user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $companiesAndInstitution->user->email ?? '' }}
                                </td>
                                <td>
                                    {{ $companiesAndInstitution->user->phone ?? '' }}
                                </td>
                                <td>
                                    @if ($companiesAndInstitution->user && $companiesAndInstitution->user->photo)
                                        <a href="{{ $companiesAndInstitution->user->photo->getUrl() }}" target="_blank"
                                            style="display: inline-block">
                                            <img src="{{ $companiesAndInstitution->user->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @foreach ($companiesAndInstitution->specializations as $key => $specialization)
                                        <span class="badge badge-info">{{ $specialization->name_ar }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <label class="c-switch c-switch-pill c-switch-success">
                                        <input onchange="update_approved(this)" value="{{$companiesAndInstitution->user_id}}" type="checkbox" class="c-switch-input" {{ ($companiesAndInstitution->user->approved ? 'checked' : null) }}>
                                        <span class="c-switch-slider"></span>
                                    </label>
                                </td>
                                <td>
                                    @can('companies_and_institution_show')
                                        <a href="{{ route('admin.companies-and-institutions.show', $companiesAndInstitution->id) }}"
                                            class="btn btn-outline-info btn-pill action-buttons-view">
                                            <i class="fas fa-eye actions-custom-i"></i>
                                        </a>
                                    @endcan

                                    @can('companies_and_institution_edit')
                                        <a href="{{ route('admin.companies-and-institutions.edit', $companiesAndInstitution->id) }}"
                                            class="btn btn-outline-success btn-pill action-buttons-edit">
                                            <i class="fa fa-edit actions-custom-i"></i>
                                        </a>
                                    @endcan

                                    @can('companies_and_institution_delete')
                                        <?php $route = route('admin.companies-and-institutions.destroy', $companiesAndInstitution->id); ?>
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



@endsection
@section('scripts')
    @parent
    <script>
        function update_approved(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('admin.users.update_approved') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    showFrontendAlert('success', "{{ trans('global.flash.user.approve') }}");
                } else {
                    showFrontendAlert('error', "{{ trans('global.flash.error') }}");
                }
            });
        }
        $(function() {
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
                order: [
                    [1, 'desc']
                ],
                pageLength: 10,
            });
            let table = $('.datatable-CompaniesAndInstitution:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
