@extends('master')

@section('content')
    <div class="well">
        <h4>Logged in successfully as {{optional($user)->email}}</h4>

        @if($user->id ===1)
            <div class="well">
                <ul>
                    @foreach ($user->unreadNotifications as $notification)
                        <li>{{ $notification->data['full_name'] }} just registered</li>
                        @php $notification->markAsRead(); @endphp
                    @endforeach
                </ul>
            </div>
        @endif
        <p>
            <img src="{{url('uploads/images',optional($user)->photo)}}" class="img-thumbnail">
        </p>
        <p>
            <a href="{{route('categories.index')}}" class="btn btn-info btn-block btn-lg font-weight-bold">Category</a>
        </p>

        <p>
            <a href="{{route('posts.index')}}" class="btn btn-info btn-block btn-lg font-weight-bold">Post</a>
        </p>
    </div>
    @stop