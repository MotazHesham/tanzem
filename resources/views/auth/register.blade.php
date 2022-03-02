@extends('layouts.app')

@section('content')
    <div style="margin:50px 40px">
        <div class="logo">
            <a href="{{ route('frontend.home') }}"><img style="height: 100px" src="{{ asset('frontend/images/logo-black-2.png') }}"
                    alt="" /></a>
        </div>
        @if ($errors->count() > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        @if(session('message'))
            <div class="alert alert-info" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="mb-4 mt-3">
            <button class="active-button" > تسجيل شركة</button>
            <form action="{{ route('frontend.cader_register')}}" style="display: inline">
                <button class="btn btn-light disabled-button" type="submit"> تسجيل كادر</button>
            </form> 
        </div> 
        
        @include('auth.partials.company') 

    </div>
@endsection

@section('scripts') 
    <script>
        Dropzone.options.photoDropzone = {
            url: '{{ route('frontend.users.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($companiesAndInstitution->user) && $companiesAndInstitution->user->photo)
                    var file = {!! json_encode($companiesAndInstitution->user->photo) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="photo" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection
