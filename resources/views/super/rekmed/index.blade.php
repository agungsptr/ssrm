@extends('layouts.super')

@section('title')
List Rekmed
@endsection

@section('content')
@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<table class="table table-bordered">
    <thead>
        <th>Rekmed ID</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>User</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($rekmed as $r)
        <tr>
            <td>{{$r->rek_id}}</td>
            <td>{{$r->rek_name}}</td>
            <td>{{$r->created_at}}</td>
            <td>{{$r->user()->name}}</td>
            <td>
                <a href="{{route('super.rekmed.show.igd', ['rek_id'=>$r->rek_id])}}" class="btn btn-primary">Go</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection