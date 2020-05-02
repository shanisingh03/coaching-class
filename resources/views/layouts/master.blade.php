<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--  Icons  --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">

    {{--  Title  --}}
    <title>@yield('title') - {{ config('app.name') }}</title>

    <!-- Common CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    {{--  ADD Page CSS  --}}
    @yield('styles')

</head>

<body class="hold-transition sidebar-mini">
    

    {{--  Content Wrapper  --}}
    <div class="wrapper" id="app">

        {{--  Loader  --}}
        <div class="loading">
            <div class='uil-ring-css' style='transform:scale(0.79);'>
                <div></div>
            </div>
        </div>

        {{--  Include Nav Bar  --}}
        @include('common.navbar')

        {{--  INclude Sidebar  --}}
        @include('common.sidebar')

        {{--  Extends Section  --}}
        @yield('content')

        {{--  Include Footer  --}}
        @include('common.footer')

    </div>

    <!-- Common Script -->
    <script src="{{asset('js/app.js')}}"></script>

    @yield('scripts')
</body>

</html>
