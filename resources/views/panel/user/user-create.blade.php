@extends('layouts.panel-app')

@section('content')




        <user-page-create prop-user-id="{{ $userid }}"
            prop-learning-modes='@json($learningmodes)'
            prop-programs='@json($programs)'
        ></user-page-create>  



@endsection
