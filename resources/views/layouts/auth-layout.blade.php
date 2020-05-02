<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{--  Icons  --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    
    {{--  Title  --}}
    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Common CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page" >
    {{--  Body Content  --}}
    <div class="login-box" id="app">

        <div class="login-logo">

            <a href="{{route('welcome')}}">
                <img src="{{asset('images/logo.png')}}" alt="logo" style="height:50px;">
                <b>{{config('app.name')}}</b>
            </a>
        </div>

        @yield('content')

    </div>

    {{--  Script Tag  --}}
    <script src="{{asset('js/app.js')}}"></script>
</body>

</html>
