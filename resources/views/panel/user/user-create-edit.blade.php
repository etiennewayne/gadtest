@extends('layouts.panel-app')

@section('content')

    <user-page-create-edit prop-user-id="{{ $userid }}"
        prop-learning-modes='@json($learningmodes)'
        prop-programs='@json($programs)'
    ></user-page-create-edit> 
        


@endsection
