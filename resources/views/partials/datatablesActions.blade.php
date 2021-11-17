
<div>
    @if($crudRoutePart == 'events')
        
        @if($row->status == 'active') 
            <a href="{{ route('admin.events.status', [ 'id' => $row->id , 'status' => 'closed']) }}" class="btn btn-outline-warning btn-pill action-buttons-ban" title="ألغاء التفعيل">
                <i  class="fas fa-ban actions-custom-i"></i>
            </a> 
        @endif

        @if($row->status == 'pending' || $row->status == 'refused' || $row->status == 'closed')  
            <a href="{{ route('admin.events.status', [ 'id' => $row->id , 'status' => 'active']) }}" class="btn btn-outline-success btn-pill action-buttons-edit" title="تفعيل">
                <i  class="fas fa-check actions-custom-i"></i>
            </a> 
        @endif 

        @if($row->status == 'pending') 
            <a href="{{ route('admin.events.status', [ 'id' => $row->id , 'status' => 'refused']) }}" class="btn btn-outline-danger btn-pill action-buttons-delete" title="رفض">
                <i  class="fas fa-times actions-custom-i"></i>
            </a> 
        @endif

    @endif
    @can($viewGate) 
        <a href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}" class="btn btn-outline-info btn-pill action-buttons-view"  title="{{ trans('global.view') }}"><i  class="fas fa-eye actions-custom-i"></i></a>
    @endcan
    
    @can($editGate) 
        <a href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}" class="btn btn-outline-success btn-pill action-buttons-edit"  title="{{ trans('global.edit') }}"><i  class="fa fa-edit actions-custom-i"></i></a>
    @endcan
    @can($deleteGate)
        <?php $route = route('admin.' . $crudRoutePart . '.destroy', $row->id); ?>
        <a  href="#" onclick="deleteConfirmation('{{$route}}')" class="btn btn-outline-danger btn-pill action-buttons-delete">
            <i  class="fa fa-trash actions-custom-i"></i>
        </a>  
    @endcan
</div>
