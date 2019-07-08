@extends('master')
@section('content')
    <h4 class="text-lg-left mb-3 mt-5">User Register an account</h4>
    @if ($errors->any())
        <div class="alert alert-danger">
            @if($errors->count()===1)
                {{$errors->first()}}
            @else
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
                @endif
        </div>
    @endif
    @if(session()->has('message'))
        <div class="alert alert-{{ session('type') }}">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ route('register') }}" method="post" class="form form-horizontal w-75" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input name="full_name" id="full_name" type="text" class="form-control" placeholder="Enter full name" value="{{ old('full_name') }}">
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input name="email" id="email" type="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input name="phone_number" id="phone_number" type="text" class="form-control" placeholder="Enter phone number" value="{{ old('phone_number') }}">
        </div>

        <div class="form-group">
            <label for="ExampleInputPhoto">Photo</label>
            <input name="photo" id="photo" type="file" class="form-control" placeholder="Upload file">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input name="password" id="password" type="password" class="form-control" placeholder="Enter password">
        </div>

        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input name="password_confirmation" id="confirm_password" type="password" class="form-control" placeholder="Enter password again">
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Register
        </button>
    </form>
@stop