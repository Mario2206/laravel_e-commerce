@extends('layouts.layout-common')

@section('main')
    <div class="pb-5">
        @include('inc.header-admin')
        @yield('content')
    </div>

@endsection
