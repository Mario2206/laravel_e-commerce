@extends('layouts.layout-common')

@section('main')
    @include('inc.header-client')
        @yield('content')
    @include('inc.footer')
@endsection
