@extends('master')
@section('jumbotron')
   @stop
@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            From the Blog
        </h3>
        @foreach ($articles as $article)
            <div class="blog-post">
                <h2 class="blog-post-title">{{$article->title}}</h2>
                <p class="blog-post-meta">{{$article->created_at->format('F d, Y h:s A')}} by
                    {{--or--}}
                {{--<p class="blog-post-meta">{{$article->created_at->diffForHumans()}} by--}}
                    <a href="#">{{$article->user['full_name']}}</a> ON
                  <a href="#">{{$article->category['name']}}</a>
                </p>

            </div>
        @endforeach
{{--<div class="pagination justify-content-center mt-5 ">--}}
    {{--{{$articles->links()}}--}}
{{--</div>--}}

       <!-- /.blog-post -->



    </div>
    @stop