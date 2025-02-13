<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>@yield('title')</title>
</head>
<body>

    @auth

    <form action="{{url('logout')}}" method="post">
        @csrf
        <button type="submit" class="btn btn-danger">logout</button>
    </form>
    @endauth
    @yield('content')

    <script src="{{asset('js/bootstrap.min.js')}}"></script>

</body>
</html>