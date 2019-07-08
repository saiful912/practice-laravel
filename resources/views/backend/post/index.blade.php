
@extends('master')
@section('content')
    <div class="well">
        <h3 class="mb-3">Post List</h3>
        <a href="{{route('posts.create')}}" class="btn btn-dark mb-3">
            Add Post
        </a>
        @if(session()->has('message'))
            <div class="alert alert-{{ session('type') }}">
                {{ session('message') }}
            </div>
        @endif
        <table class="table table-bordered table-condensed">
            <thead>
            <tr>
                <th>ID</th>
                <th>Post Title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            @foreach($posts as $post)
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->category['name']}}</td>
                    {{--<td><img src="{{url('uploads/images',optional($post)->user['photo'])}}" alt="" width="100px" height="100px"></td>--}}
                    <td>{{$post->user['full_name']}}</td>
                    <td>{{$post->status===1 ? 'Active' : 'Inactive'}}</td>
                    <td>
                        <a href="{{route('posts.show',$post->id)}}" class="btn btn-info">
                            Details
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center">
            {!! $posts->links() !!}
        </div>

    </div>
@stop