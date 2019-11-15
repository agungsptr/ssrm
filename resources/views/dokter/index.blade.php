@extends('layouts.main')
@section('title') Dokter @endsection
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center mb-3">
        <img src="img/logo-rsia-ph.png" width="300px" alt="rsia-ph">
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-8">
            <form action="{{route('dokter.index')}}">
                <div class="input-group input-group-lg mb-3">
                    <input name="search" type="text" class="form-control" placeholder="Search No Rekam Medis"
                        aria-label="Search No Rekam Medis" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <input class="btn btn-outline-primary" type="submit" id="button-addon2" value="Search">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-8">
            <div class="list-group">
                @isset($find)
                <small>Result : </small>
                @if ($find == '[]')
                <div href="" class="list-group-item list-group-item-action">Not Found</div>
                @else
                @foreach ($find as $f)
                <a href="{{route('dokter.show', ['rek_id'=>$f->rek_id])}}"
                    class="list-group-item list-group-item-action">{{$f->rek_id}} - {{$f->rek_name}}</a>
                @endforeach
                @endif
                @endisset
            </div>
        </div>
    </div>
</div>
@endsection