@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.setting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.settings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="address">{{ trans('cruds.setting.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_1">{{ trans('cruds.setting.fields.phone_1') }}</label>
                <input class="form-control {{ $errors->has('phone_1') ? 'is-invalid' : '' }}" type="text" name="phone_1" id="phone_1" value="{{ old('phone_1', '') }}" required>
                @if($errors->has('phone_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.phone_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone_2">{{ trans('cruds.setting.fields.phone_2') }}</label>
                <input class="form-control {{ $errors->has('phone_2') ? 'is-invalid' : '' }}" type="text" name="phone_2" id="phone_2" value="{{ old('phone_2', '') }}">
                @if($errors->has('phone_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.phone_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email_1">{{ trans('cruds.setting.fields.email_1') }}</label>
                <input class="form-control {{ $errors->has('email_1') ? 'is-invalid' : '' }}" type="email" name="email_1" id="email_1" value="{{ old('email_1') }}" required>
                @if($errors->has('email_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.email_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email_2">{{ trans('cruds.setting.fields.email_2') }}</label>
                <input class="form-control {{ $errors->has('email_2') ? 'is-invalid' : '' }}" type="email" name="email_2" id="email_2" value="{{ old('email_2') }}">
                @if($errors->has('email_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.email_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="facebook">{{ trans('cruds.setting.fields.facebook') }}</label>
                <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="text" name="facebook" id="facebook" value="{{ old('facebook', '') }}">
                @if($errors->has('facebook'))
                    <div class="invalid-feedback">
                        {{ $errors->first('facebook') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.facebook_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gmail">{{ trans('cruds.setting.fields.gmail') }}</label>
                <input class="form-control {{ $errors->has('gmail') ? 'is-invalid' : '' }}" type="text" name="gmail" id="gmail" value="{{ old('gmail', '') }}">
                @if($errors->has('gmail'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gmail') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.gmail_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="linkedin">{{ trans('cruds.setting.fields.linkedin') }}</label>
                <input class="form-control {{ $errors->has('linkedin') ? 'is-invalid' : '' }}" type="text" name="linkedin" id="linkedin" value="{{ old('linkedin', '') }}">
                @if($errors->has('linkedin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('linkedin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.linkedin_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="instagram">{{ trans('cruds.setting.fields.instagram') }}</label>
                <input class="form-control {{ $errors->has('instagram') ? 'is-invalid' : '' }}" type="text" name="instagram" id="instagram" value="{{ old('instagram', '') }}">
                @if($errors->has('instagram'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instagram') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.instagram_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="twitter">{{ trans('cruds.setting.fields.twitter') }}</label>
                <input class="form-control {{ $errors->has('twitter') ? 'is-invalid' : '' }}" type="text" name="twitter" id="twitter" value="{{ old('twitter', '') }}">
                @if($errors->has('twitter'))
                    <div class="invalid-feedback">
                        {{ $errors->first('twitter') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.twitter_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="latitude">{{ trans('cruds.setting.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text" name="latitude" id="latitude" value="{{ old('latitude', '') }}">
                @if($errors->has('latitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('latitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.setting.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text" name="longitude" id="longitude" value="{{ old('longitude', '') }}">
                @if($errors->has('longitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('longitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="home_text_1">{{ trans('cruds.setting.fields.home_text_1') }}</label>
                <input class="form-control {{ $errors->has('home_text_1') ? 'is-invalid' : '' }}" type="text" name="home_text_1" id="home_text_1" value="{{ old('home_text_1', '') }}">
                @if($errors->has('home_text_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('home_text_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.home_text_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="home_text_2">{{ trans('cruds.setting.fields.home_text_2') }}</label>
                <textarea class="form-control {{ $errors->has('home_text_2') ? 'is-invalid' : '' }}" name="home_text_2" id="home_text_2">{{ old('home_text_2') }}</textarea>
                @if($errors->has('home_text_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('home_text_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.home_text_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="about_us">{{ trans('cruds.setting.fields.about_us') }}</label>
                <textarea class="form-control {{ $errors->has('about_us') ? 'is-invalid' : '' }}" name="about_us" id="about_us" required>{{ old('about_us') }}</textarea>
                @if($errors->has('about_us'))
                    <div class="invalid-feedback">
                        {{ $errors->first('about_us') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.about_us_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="caders_text">{{ trans('cruds.setting.fields.caders_text') }}</label>
                <textarea class="form-control {{ $errors->has('caders_text') ? 'is-invalid' : '' }}" name="caders_text" id="caders_text">{{ old('caders_text') }}</textarea>
                @if($errors->has('caders_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('caders_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.caders_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="events_text">{{ trans('cruds.setting.fields.events_text') }}</label>
                <textarea class="form-control {{ $errors->has('events_text') ? 'is-invalid' : '' }}" name="events_text" id="events_text">{{ old('events_text') }}</textarea>
                @if($errors->has('events_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('events_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.events_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="news_text">{{ trans('cruds.setting.fields.news_text') }}</label>
                <textarea class="form-control {{ $errors->has('news_text') ? 'is-invalid' : '' }}" name="news_text" id="news_text">{{ old('news_text') }}</textarea>
                @if($errors->has('news_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('news_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.news_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="how_we_work_header">{{ trans('cruds.setting.fields.how_we_work_header') }}</label>
                <textarea class="form-control {{ $errors->has('how_we_work_header') ? 'is-invalid' : '' }}" name="how_we_work_header" id="how_we_work_header">{{ old('how_we_work_header') }}</textarea>
                @if($errors->has('how_we_work_header'))
                    <div class="invalid-feedback">
                        {{ $errors->first('how_we_work_header') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.how_we_work_header_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="how_we_work_1">{{ trans('cruds.setting.fields.how_we_work_1') }}</label>
                <textarea class="form-control {{ $errors->has('how_we_work_1') ? 'is-invalid' : '' }}" name="how_we_work_1" id="how_we_work_1">{{ old('how_we_work_1') }}</textarea>
                @if($errors->has('how_we_work_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('how_we_work_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.how_we_work_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="how_we_work_2">{{ trans('cruds.setting.fields.how_we_work_2') }}</label>
                <textarea class="form-control {{ $errors->has('how_we_work_2') ? 'is-invalid' : '' }}" name="how_we_work_2" id="how_we_work_2">{{ old('how_we_work_2') }}</textarea>
                @if($errors->has('how_we_work_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('how_we_work_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.how_we_work_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="how_we_work_3">{{ trans('cruds.setting.fields.how_we_work_3') }}</label>
                <textarea class="form-control {{ $errors->has('how_we_work_3') ? 'is-invalid' : '' }}" name="how_we_work_3" id="how_we_work_3">{{ old('how_we_work_3') }}</textarea>
                @if($errors->has('how_we_work_3'))
                    <div class="invalid-feedback">
                        {{ $errors->first('how_we_work_3') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.how_we_work_3_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="said_about_tanzem">{{ trans('cruds.setting.fields.said_about_tanzem') }}</label>
                <textarea class="form-control {{ $errors->has('said_about_tanzem') ? 'is-invalid' : '' }}" name="said_about_tanzem" id="said_about_tanzem">{{ old('said_about_tanzem') }}</textarea>
                @if($errors->has('said_about_tanzem'))
                    <div class="invalid-feedback">
                        {{ $errors->first('said_about_tanzem') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.said_about_tanzem_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="organizers_text">{{ trans('cruds.setting.fields.organizers_text') }}</label>
                <textarea class="form-control {{ $errors->has('organizers_text') ? 'is-invalid' : '' }}" name="organizers_text" id="organizers_text">{{ old('organizers_text') }}</textarea>
                @if($errors->has('organizers_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('organizers_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.organizers_text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_us_text">{{ trans('cruds.setting.fields.contact_us_text') }}</label>
                <textarea class="form-control {{ $errors->has('contact_us_text') ? 'is-invalid' : '' }}" name="contact_us_text" id="contact_us_text">{{ old('contact_us_text') }}</textarea>
                @if($errors->has('contact_us_text'))
                    <div class="invalid-feedback">
                        {{ $errors->first('contact_us_text') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.setting.fields.contact_us_text_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection