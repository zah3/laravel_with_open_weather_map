<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    </head>
    <body>
        @include('layouts.header')
            @yield('content')
        @include('layouts.footer')
    </body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" ></script>
    <script>
        $("#content").css("bottom", $("footer").outerHeight());
    </script>
</html>