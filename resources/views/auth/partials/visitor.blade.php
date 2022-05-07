<form method="POST" action="{{ route('frontend.register.visitor') }}" enctype="multipart/form-data" id="form-visitor">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name"
                value="{{ old('name', '') }}" required>
            @if ($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                id="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                name="password" id="password" required>
            @if ($errors->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone"
                id="phone" value="{{ old('phone', '') }}" required>
            @if ($errors->has('phone'))
                <div class="invalid-feedback">
                    {{ $errors->first('phone') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required" for="national">{{ trans('cruds.visitor.fields.national') }}</label>
            <input class="form-control {{ $errors->has('national') ? 'is-invalid' : '' }}" type="text" name="national"
                id="national" value="{{ old('national', '') }}" required>
            @if ($errors->has('national'))
                <div class="invalid-feedback">
                    {{ $errors->first('national') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.visitor.fields.national_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required" for="photo">{{ trans('cruds.user.fields.photo') }}</label>
            <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}" id="photo-dropzone">
            </div>
            @if ($errors->has('photo'))
                <div class="invalid-feedback">
                    {{ $errors->first('photo') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.user.fields.photo_helper') }}</span>
        </div>
    </div>

    <div class="form-group">
        <div>
            <input type="checkbox" id="terms_cader" name="terms_cader" value="terms_cader" required>
            <label for="terms_cader" style="display: inline">أوافق علي <a href="{{ route('frontend.terms',2) }}"  target="_blank">الشروط والأحكام</a></label> 
        </div> 
        <br>
        <button class="site-button button-md btn-block" type="submit">تسجيل</button>
    </div>
    <div class="form-group">
        <p class="info-bottom">
            <a href="{{ route('login') }}" class="btn-link">لديك حساب
                بالفعل </a>
        </p>
    </div>
</form>

