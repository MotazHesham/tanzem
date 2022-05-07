@extends('layouts.admin')
@section('styles')
    <style>
.listing-filter{
	padding: 15px;
	background: #fff;
	border: 2px solid #ecebf5;
}
.listing-filter .filter li,
.listing-filter .filter-icon li{
	list-style: none;
	display: inline-block;
}
.listing-filter .filter-icon li a {
	padding: 0;
	color: #fff;
	font-size: 14px;
	line-height: 40px;
	background: var(--bg-color);
	border-radius: 30px;
	width: 40px;
	height: 40px;
	display: inline-block;
	text-align: center;
}
.listing-filter .filter-icon li a:hover{
	background: var(--bg-color-ho);
}
.listing-filter .filter .btn.dropdown-toggle.btn-default {
    font-size: 14px;
    border: 0 !important;
    padding: 10px 30px 10px 20px;
	color: #fff;
	border-radius: 30px;
	background: var(--bg-color) !important;
}
.listing-filter .filter .bootstrap-select.btn-group .dropdown-toggle .caret{
	right: 20px;
}
.listing-filter .filter  .btn.dropdown-toggle.btn-default:hover,
.listing-filter .filter .show .btn.dropdown-toggle.btn-default{
	color: #fff;
	background: var(--bg-color-ho) !important;
}
.listing-filter .filter .btn.dropdown-toggle.btn-default .caret::before {
    content: "\f078";
	font-size: 9px;
	font-family: FontAwesome;
	color: #fff;
	font-weight: 500;
	line-height: 20px;
}
.listing-filter .bootstrap-select .dropdown-menu > li{
	display: block;
}
.listing-filter .bootstrap-select .dropdown-menu > li > a:hover,
.listing-filter-sidebar  .bootstrap-select .dropdown-menu > li > a:hover{
    background-color: var(--bg-color);
	color: #fff;
}
.listing-filter .bootstrap-select div.dropdown-menu,
.listing-filter-sidebar .bootstrap-select div.dropdown-menu {
	border: 0;
	box-shadow: 0 0 30px 0px rgba(3,0,54,0.15);
}

/* Listing Filter Sidebar */
.listing-filter-sidebar{
    border: 2px solid #ecebf5;
	margin-bottom: -2px;
	padding: 30px 20px 10px;
}
.add img{
	width: 100%;
}
.listing-filter-sidebar .title:before{
	content: "";
	width: 4px;
	height: 100%;
	background-color: var(--bg-color);
	position: absolute;
	top: 0;
	left: 0;
}
.listing-filter-sidebar .title {
    font-size: 20px;
    font-weight: 700;
    position: relative;
    padding-left: 20px;
}
.listing-filter-sidebar .form-group .btn.dropdown-toggle.btn-default,
.listing-filter-sidebar .form-group .form-control{
    background-color: #fff !important;
    height: 50px;
    padding:15px 30px;
	color: #7b7d86;
	border-radius: 50px;
	box-shadow: 0 3px 10px 0 rgba(0,0,0, 0.05);
}
.listing-filter-sidebar .form-group .btn.dropdown-toggle.btn-default .caret::before {
    content: "\f107";
    font-weight: 800;
    padding-right: 17px;
    line-height: 40px;
}
.listing-filter-sidebar .form-group .input-group{
	
}
.listing-filter-sidebar .form-group{
	margin-bottom: 20px;
}
.listing-filter-sidebar .form-group .input-group-text {
    border: 0;
    background-color: #f6f5ff;
    padding:20px 30px 20px 0px;
}
.listing-filter-sidebar .form-group .btn.dropdown-toggle.btn-default{
	border-radius: 50px;
}
    </style>
@endsection
@section('content')
<div class="listing-filter m-b40">
    <div class="d-flex">
        <div class="ml-auto">
            <form action="" id="search_cader" > 
                <ul class="filter m-b0">
                    <div class="row">
                    <li class="col-md-6">
                        <select name="specialization_id" id="specialization_id">
                            <option value="">
                               التخصص
                            </option>
                            @foreach(\App\Models\CawaderSpecialization::get() as $specialization)
                                <option value="{{ $specialization->id }}" @isset($specialization_id) @if($specialization_id == $specialization->id) selected @endif @endisset>{{ $specialization->name_ar }}</option> 
                            @endforeach
                               
                          
                        </select>
                    </li>
                    <li class="col-md-6">
                        <select name="skill_id" id="skill_id">
                            <option value="">
                            المهارات
                            </option>
                            
                            @foreach(\App\Models\Skill::get() as $skill)
                            <option value="{{ $skill->id }}" @isset($skill_id) @if($skill_id == $skill->id) selected @endif @endisset>{{ $skill->name_ar }}</option> 
                        @endforeach
                        </select>
                    </li>
                    </div>
                </ul>
            </form>
        </div>
    </div>
</div>
<div class="partials-scrollable mt-3 col-md-6">
    <form action="{{route('admin.events.save_cawder')}}" method="Post">
        @csrf
        <input type="hidden" value="{{$event_id}}" name="event_id">
<table>
    <h5>الكوادر المتفرغين للعمل  </h5>
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
    </tr>
    <tr>
        @if ($errors->has('cawaders'))
            <div class="text-danger">
                {{ $errors->first('cawaders') }}
            </div>
        @endif
    </tr>
    @foreach ($cawaders_full_time as $cawader)
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
        </tr>
    @endforeach
</table>

</div>
<div class="form-group">
    <button class="btn btn-danger" type="submit">
        {{ trans('global.save') }}
    </button>
</form>
</div>
@endsection
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
     <script>
        $('#specialization_id').on('change',function(){
            $('#search_cader').submit();
        });
        $('#skill_id').on('change',function(){
            $('#search_cader').submit();
        });
    </script>
@endsection
