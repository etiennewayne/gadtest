@extends('layouts.no-navbar')

@section('extracss')


<style>
    @page {
        size: 8.5in 13in;
    }

    .print-table{
        margin: auto;
        font-size: .8em;
    }

    .print-table tr td{
        padding: 3px;
        border: 1px solid gray;
    }

    .print-table tr th{
        padding: 5px;
        border: 2px solid gray;
    }

    .print-title{
        text-align: center;
        font-weight: bold;
    }


</style>

@endsection


@section('content')

<div class="print-title">STUDENT LIST</div>
<div class="print-title">Schedule: {{ date('Y-m-d', $schedule->from) }}, {{ date('h:i A', $schedule->from) }}</div>

<table class="print-table">
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Sex</th>
        <th>Contact No.</th>
        <th>1st Program</th>
        <th>2nd Program</th>
    </tr>
    @foreach($schedule->students as $key => $std)
        <tr>
            <td>{{ ($key + 1) }}</td>
            <td>{{ $std->lname }}, {{ $std->fname }} {{ $std->mname }} {{ $std->suffix }}</td>
            <td>{{ $std->sex }}</td>
            <td>{{ $std->contact_no }}</td>
            <td>{{ $std->first_program_choice }}</td>
            <td>{{ $std->second_program_choice }}</td>
            
    @endforeach
</table>



@endsection
