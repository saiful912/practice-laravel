


@extends('master')
@section('content')
    <h4 class="text-left mb-3 mt-5" style="padding-left: 195px">Log in Here</h4>
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
    <form action="{{ route('login') }}" method="post" class="form form-horizontal w-75" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="email">Email Address</label>
            <input name="email" id="email" type="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input name="password" id="password" type="password" class="form-control" placeholder="Enter password">
        </div>

        <button type="submit" class="btn btn-primary btn-block">
           Login
        </button>

        <div class="form-group" >
            <a href="{{route('register')}}" class="btn btn-sm btn-primary btn-block mt-2" style="font-size: 18px;">Create first your account</a>
        </div>
    </form>
    @stop