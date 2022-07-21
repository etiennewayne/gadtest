@extends('layouts.panel-app')

@section('content')

    <admission-students-result prop-programs='@json($programs)'></admission-students-result>

@endsection
