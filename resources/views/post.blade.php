@extends('master')
@section('content')

        <div class="blog-post">
            <h2 class="blog-post-title">{{$post['title']}}</h2>
            <p class="blog-post-meta">{{$post['create_at']}}</p>

{!!$post['description']!!}


        </div>


    @stop