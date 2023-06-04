@extends('layouts.panel-app')

@section('content')
    @if(Auth::user()->role == 'STAFF')
        <test-schedule-staff></test-schedule-staff>
    @else
        <test-schedule></test-schedule>   
    @endif

@endsection
