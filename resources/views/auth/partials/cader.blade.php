<form method="POST" action="{{ route('frontend.register.cader') }}" enctype="multipart/form-data" id="form-cader">
    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                id="name" value="{{ old('name', '') }}" required>
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
            <label class="required" for="dob">{{ trans('cruds.cawader.fields.dob') }}</label>
            <input class="form-control date {{ $errors->has('dob') ? 'is-invalid' : '' }}" type="text" name="dob"
                id="dob" value="{{ old('dob') }}" required>
            @if ($errors->has('dob'))
                <div class="invalid-feedback">
                    {{ $errors->first('dob') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.cawader.fields.dob_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required">{{ trans('cruds.cawader.fields.degree') }}</label>
            <select class="form-control {{ $errors->has('degree') ? 'is-invalid' : '' }}" name="degree" id="degree"
                required>
                <option value disabled {{ old('degree', null) === null ? 'selected' : '' }}>
                    {{ trans('global.pleaseSelect') }}</option>
                @foreach (App\Models\Cawader::DEGREE_SELECT as $key => $label)
                    <option value="{{ $key }}" {{ old('degree', '') === (string) $key ? 'selected' : '' }}>
                        {{ trans('global.degree.' . $label) }}</option>
                @endforeach
            </select>
            @if ($errors->has('degree'))
                <div class="invalid-feedback">
                    {{ $errors->first('degree') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.cawader.fields.degree_helper') }}</span>
        </div>
        <div class="form-group col-md-6 ">
            <label class="required"
                for="city_id">{{ trans('cruds.companiesAndInstitution.fields.city') }}</label>
            <select class="{{ $errors->has('city') ? 'is-invalid' : '' }}" name="city_id" id="city_id">
                @foreach (\App\Models\City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '') as $id => $entry)
                    <option value="{{ $id }}" {{ old('city_id') == $id ? 'selected' : '' }}>
                        {{ $entry }}</option>
                @endforeach
            </select>
            @if ($errors->has('city'))
                <div class="invalid-feedback">
                    {{ $errors->first('city') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.companiesAndInstitution.fields.city_helper') }}</span>
        </div>
        <div class="form-group col-md-6 ">
            <label class="required"
                for="specializations">{{ trans('cruds.companiesAndInstitution.fields.specializations') }}</label>
            <select class="{{ $errors->has('specializations') ? 'is-invalid' : '' }}" name="specializations[]"
                id="specializations" multiple>
                @foreach (\App\Models\Specialization::pluck('name_ar', 'id') as $id => $specialization)
                    <option value="{{ $id }}"
                        {{ in_array($id, old('specializations', [])) ? 'selected' : '' }}>
                        {{ $specialization }}</option>
                @endforeach
            </select>
            @if ($errors->has('specializations'))
                <div class="invalid-feedback">
                    {{ $errors->first('specializations') }}
                </div>
            @endif
            <span
                class="help-block">{{ trans('cruds.companiesAndInstitution.fields.specializations_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required"
                for="working_hours">{{ trans('cruds.cawader.fields.working_hours') }}</label>
            <input class="form-control {{ $errors->has('working_hours') ? 'is-invalid' : '' }}" type="number"
                name="working_hours" id="working_hours" value="{{ old('working_hours', '') }}" step="1" required>
            @if ($errors->has('working_hours'))
                <div class="invalid-feedback">
                    {{ $errors->first('working_hours') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.cawader.fields.working_hours_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label class="required"
                for="identity_number">{{ trans('cruds.cawader.fields.identity_number') }}</label>
            <input class="form-control {{ $errors->has('identity_number') ? 'is-invalid' : '' }}" type="text"
                name="identity_number" id="identity_number" value="{{ old('identity_number', '') }}" required>
            @if ($errors->has('identity_number'))
                <div class="invalid-feedback">
                    {{ $errors->first('identity_number') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.cawader.fields.identity_number_helper') }}</span>
        </div>
        <div class="form-group col-md-6">
            <label for="desceiption">{{ trans('cruds.cawader.fields.desceiption') }}</label>
            <textarea class="form-control {{ $errors->has('desceiption') ? 'is-invalid' : '' }}" name="desceiption" 
                id="desceiption" style="height: 150px">{{ old('desceiption') }}</textarea>
            @if ($errors->has('desceiption'))
                <div class="invalid-feedback">
                    {{ $errors->first('desceiption') }}
                </div>
            @endif
            <span class="help-block">{{ trans('cruds.cawader.fields.desceiption_helper') }}</span>
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
        <button class="site-button button-md btn-block" type="submit">تسجيل</button>
    </div>
    <div class="form-group">
        <p class="info-bottom">
            <a href="{{ route('login') }}" class="btn-link">لديك حساب
                بالفعل </a>
        </p>
    </div>
</form>
