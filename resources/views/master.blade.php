<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{('practice_laravel')}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    {{--<link rel="stylesheet" href="{{mix('css/app.css')}}" >--}}
    <link rel="stylesheet" href="//getbootstrap.com/docs/4.3/examples/blog/blog.css" >
    {{--<link rel="stylesheet" href="{{mix('css/blog.css')}}" >--}}


</head>
<body>

<div class="container">


    @include('partials.navbar')
   @yield('jumbotron')
</div>
<main role="main" class="container" id="app">
    <div class="row">
        <div class="col-md-8 blog-main">
        <!-- /.blog-main -->
        @yield('content')
        </div>


        @include('partials.sidebar')

    </div><!-- /.row -->


</main><!-- /.container -->
@include('partials.footer')

<script src="{{mix('js/app.js')}}"></script>

 {{--fontpage notify--}}
<script>
    Echo.public('post.created')
        .listen('PostCreated', (e) => {
        $.notify(e.post.title + ' has been published now');
    });
</script>


</body>
</html>
