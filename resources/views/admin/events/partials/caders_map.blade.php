<h5 class="text-center mb-2">الكوادر في الفعالية</h5>
@foreach($event->cawaders as $cader) 
    <div class="card" onclick="zoomInMap('{{ $cader->id }}')" style="cursor: pointer"> 
        <div class="card-body"> 
            <div class="row">
                <div class="col-md-6">
                    @if ($cader->user && $cader->user->photo)
                        @php
                            $image = str_replace('public/public','public',asset($cader->user->photo->getUrl('thumb')));
                        @endphp
                        <img src="{{ $image  }}" alt="avatar">
                    @else
                        <img src="{{ asset('user.png') }}" width="50" height="50" alt="avatar">
                    @endif 
                    <br>
                    <span class="badge badge-light">
                        {{ $cader->user->name }}
                    </span> 
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-outline-info" onclick="cader_attendance({{$cader->id}})">سجل الحضور</button> 
                    <button type="button" class="btn btn-outline-success" onclick="cader_break({{$cader->id}})">
                        طلبات الأذن
                        <span class="badge badge-light"> {{ \App\Models\EventBreak::where('cawader_id',$cader->id)->where('event_id',$event->id)->count() }} </span>
                    </button> 
                </div>
            </div> 
        </div>
    </div> 
@endforeach