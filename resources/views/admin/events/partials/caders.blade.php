<table>
    <tr>
        <td>
        </td>
        <td>
            <label for="cawaders">{{ trans('cruds.event.fields.cawaders') }}</label>
        </td>
        <td>
            عدد الساعات لليوم
        </td>
        <td>
            اليومية
        </td>
        <td>
            الساعة الأضافية = الساعة العادية
        </td>
        <td>
               حالة الطلب
        </td>
    </tr>
    <tr>
        @if ($errors->has('cawaders'))
            <div class="text-danger">
                {{ $errors->first('cawaders') }}
            </div>
        @endif
    </tr>
    @foreach ($cawaders as $cawader)
        <tr>
            <td><input {{ old('cawaders.' . $cawader->id, $cawader->hours) ? 'checked' : null }}
                    data-id="{{ $cawader->id }}" data-working_hours="{{ $cawader->working_hours }}" type="checkbox" class="cawader-enable"></td>

           <td> <a href="{{ route('frontend.cader',$cawader->id)}}" target="_blank">{{ $cawader->user->name }}</a></td>

            <td><input value="{{ old('cawaders.' . $cawader->id . '.hours', $cawader->hours) ?? null }}"
                    {{ old('cawaders.' . $cawader->id, $cawader->hours) ? null : 'disabled' }}
                    data-id="{{ $cawader->id }}" name="cawaders[{{ $cawader->id }}][hours]" type="number" min="0" step="0.1"
                    class="cawader-hours form-control {{ $errors->has('cawaders.' . $cawader->id . '.hours') ? 'is-invalid' : '' }}" placeholder="{{ $cawader->working_hours }} ساعة"></td>

            <td><input value="{{ old('cawaders.' . $cawader->id . '.amount', $cawader->amount) ?? null }}"
                    {{ old('cawaders.' . $cawader->id, $cawader->hours) ? null : 'disabled' }}
                    data-id="{{ $cawader->id }}" name="cawaders[{{ $cawader->id }}][amount]" type="number" min="0" step="0.1"
                    class="cawader-amount form-control {{ $errors->has('cawaders.' . $cawader->id . '.amount') ? 'is-invalid' : '' }}" placeholder="التكلفة لليوم"></td>

            <td><input value="{{ old('cawaders.' . $cawader->id . '.extra_hours', $cawader->extra_hours) ?? null }}"
                    {{ old('cawaders.' . $cawader->id, $cawader->hours) ? null : 'disabled' }}
                    data-id="{{ $cawader->id }}" name="cawaders[{{ $cawader->id }}][extra_hours]" type="number"
                    min="0" step="0.1" class="cawader-extra-hours form-control {{ $errors->has('cawaders.' . $cawader->id . '.extra_hours') ? 'is-invalid' : '' }}" placeholder="1 = 1.5"></td>
        </tr>
        <tr>
            <td> </td>
            <td> </td>
            <td>
                @if ($errors->has('cawaders.' . $cawader->id . '.hours'))
                    <div class="text-danger">
                        هذا الحقل مطلوب
                    </div>
                @endif
            </td>
            <td>
                @if ($errors->has('cawaders.' . $cawader->id . '.amount'))
                    <div class="text-danger">
                        هذا الحقل مطلوب
                    </div>
                @endif
            </td>
            <td>
                @if ($errors->has('cawaders.' . $cawader->id . '.extra_hours'))
                    <div class="text-danger">
                        هذا الحقل مطلوب
                    </div>
                @endif
            </td>
            <td>
                @if($cawader->status==2)
                <label for="cawaders" class="badge badge-primary">قيد الأنتظار</label>
                @elseif($cawader->status==1)
                <label for="cawaders" class="badge badge-info">تمت الموافقه</label>
                @elseif($cawader->status==0)
                <label for="cawaders" class="badge badge-warning">تم الرفض</label>
                @else
                  <label></labe>
                @endif
            </td>
        </tr>
    @endforeach
</table>

@section('scripts')
    @parent
    <script>
        $('document').ready(function() {
            $('.cawader-enable').on('click', function() {
                let id = $(this).attr('data-id')
                let working_hours = $(this).attr('data-working_hours')
                let enabled = $(this).is(":checked")
                $('.cawader-hours[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.cawader-hours[data-id="' + id + '"]').val(working_hours)

                $('.cawader-amount[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.cawader-amount[data-id="' + id + '"]').val(100)

                $('.cawader-extra-hours[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.cawader-extra-hours[data-id="' + id + '"]').val(1.5)
            })
        });
    </script>
@endsection
