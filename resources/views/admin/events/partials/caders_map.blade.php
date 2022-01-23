<h5 class="text-center mb-2">الكوادر في الفعالية</h5>
<form action="{{ route('admin.events.partials.supervisor') }}" method="post">
    @csrf
    <input type="hidden" name="event_id" value="{{ $event->id }}">
    <div class="row">
        <div class="form-group col-md-6">
            <label class="required" for="supervisor_id">{{ trans('cruds.event.fields.supervisor') }}</label>
            <select name="supervisor_id" class="form-control" id="">
                @foreach (\App\Models\Cawader::where('companies_and_institution_id', $event->company_id)->orderBy('created_at', 'desc')->get() as $supervisor)
                    <option value="{{ $supervisor->id }}">{{ $supervisor->user->name ?? '' }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <br>
            <button class="btn btn-danger" type="submit">
                {{ trans('global.save') }}
            </button>
        </div>
    </div>
    <table class="table table-bordered" style="background: white">
        <thead>
            <td></td>
            <td>الكادر</td>
            <td>المشرف</td>
            <td></td>
        </thead>
        <tbody>
            @foreach ($event->cawaders as $cader)
                <tr onclick="zoomInMap('{{ $cader->id }}')" style="cursor: pointer">
                    <td>
                        <input type="checkbox" name="cawaders[]" value="{{$cader->id}}">
                    </td>
                    <td>
                        @if ($cader->user && $cader->user->photo)
                            @php
                                $image = str_replace('public/public', 'public', asset($cader->user->photo->getUrl('thumb')));
                            @endphp
                            <img src="{{ $image }}" alt="avatar">
                        @else
                            <img src="{{ asset('user.png') }}" width="50" height="50" alt="avatar">
                        @endif
                        {{ $cader->user->name }}
                    </td>
                    <td>
                        {{ \App\Models\Cawader::find($cader->pivot->supervisor_id)->user->name ?? ''}}
                    </td>
                    <td>
                        <button type="button" class="btn btn-outline-info btn-sm"
                            onclick="cader_attendance({{ $cader->id }})">سجل الحضور</button>
                            <br>
                        <button type="button" class="btn btn-outline-success btn-sm"
                            onclick="cader_break({{ $cader->id }})">
                            طلبات الأذن
                            <span class="badge badge-light">
                                {{ \App\Models\EventBreak::where('cawader_id', $cader->id)->where('event_id', $event->id)->count() }}
                            </span>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form> 