@extends('layouts.panel-app')

@section('content')

    <current-user-page-create-edit prop-user-id="{{ $userid }}"
        prop-learning-modes='@json($learningmodes)'
        prop-programs='@json($programs)'
    ></current-user-page-create-edit> 
        


@endsection
