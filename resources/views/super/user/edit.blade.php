@extends('layouts.main')

@section('title')
Edit User
@endsection
@section('menu')
<a href="{{route('super.index')}}" class="nav-item nav-link">Dashboard</a>
<a class="nav-link" href="{{-- {{route('logupload')}} --}}">Log Upload</a>
<a class="nav-link active" href="{{route('user.index')}}">Manage Users</a>
<a class="nav-link" href="{{route('super.rekmed')}}">Manage Rekmed</a>
@endsection

@section('content')
<div class="col-md-8 mb-3">
    <a href="{{route('user.index')}}" class="btn btn-primary mb-3">Back</a>
    <div class="card">
        <div class="card-header">
            Edit User
        </div>
        <div class="card-body">
            <form enctype="multipart/form-data" action="{{route('user.update', ['id'=>$user->id])}}" method="POST">
                @csrf
                <input type="hidden" value="PUT" name="_method">

                <label for="name">Name</label>
                <input value="{{$user->name}}" class="form-control" type="text" name="name" id="name" />
                <br>

                <label for="username">Username</label>
                <input value="{{$user->username}}" class="form-control" type="text" name="username" id="username" />
                <br>

                <label for="email">Email</label>
                <input value="{{$user->email}}" class="form-control" type="email" name="email" id="email" />
                <br>

                <label for="role">Role</label>
                <br>
                <select name="role" id="role" class="form-control">
                    <option value="SUPERVISOR" {{$user->role == 'SUPERVISOR' ? 'selected' : ''}}>Supervisor</option>
                    <option value="ADMIN" {{$user->role == 'ADMIN' ? 'selected' : ''}}>Admin</option>
                    <option value="DOKTER" {{$user->role == 'DOKTER' ? 'selected' : ''}}>Dokter</option>
                </select>
                <br>

                <label for="password">New Password</label>
                <input class="form-control" type="password" name="password" id="password" />
                <br>

                <label for="password_confirmation">Password Confirmation</label>
                <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" />
                <br>
        </div>
        <div class="card-footer">
            <input type="submit" class="btn btn-primary" value="Simpan">
            <input type="reset" class="btn btn-danger" value="Reset">
            </form>
        </div>
    </div>
</div>
@endsection