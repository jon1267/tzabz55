<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::to('src/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('css/jon_styles.css')}}">

    <!-- JAVASCRIPTs ckeditor & выбор картинки по др. никак (токо в таком порядке) -->
    {{--<script src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>--}}
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>

    {{--
    <script type="text/javascript" src="{{URl::to('js/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript" src="{{URl::to('js/bootstrap-filestyle.min.js')}}"></script>
    --}}
    <script src="{{asset('js/jon_scripts.js')}}"></script>

    @yield('styles')

</head>
<body>
@include('site.header')

<div class="container">
    @yield('status')
</div>

<div class="container">
    @yield('content')
</div>


{{--<script src="https://code.jquery.com/jquery-3.2.1.js"></script>--}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@yield('javascripts')

</body>
</html>