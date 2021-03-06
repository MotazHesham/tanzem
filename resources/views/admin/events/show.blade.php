@extends('layouts.admin')

@section('styles')
    <style>
        .nav-tabs .nav-item .nav-link {
            padding: 12px;
            color: #5D6D7E
        }
    </style>
@endsection

@section('content')

    @include('admin.events.forms.show')

@endsection

@section('scripts')
    @parenti

    @include('map_scripts.events.show')

@endsection
