@extends('layouts.panel-app')

@section('content')



    @if ($userid > 0)
        <user-page-create prop-user-id="{{ $userid }}"
            prop-learning-modes='@json($learningmodes)'
            prop-programs='@json($programs)'
        ></user-page-create>  
    @else
        <user-page-create prop-user-id="{{ $userid }}"></user-page-create>
    @endif


@endsection
