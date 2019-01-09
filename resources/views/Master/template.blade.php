<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>University Of Computer Studies(Mandalay) Voting Site</title>
    <link rel="stylesheet" href="{!! asset('css/bootstrap-cerulean.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/app.css') !!}">
    <link rel="stylesheet" href="{!! asset('fontawesome-free-5.5.0-web/css/all.css') !!}">
</head>
<body>

@yield('body')

@include('Master.footer')

<script src="{!! asset('/js/jquery-3.3.1.js') !!}"></script>
<script src = "{!! asset('js/jsqrcode.js') !!}"></script>
<script src = "{!! asset('js/ajaxRequestFunction.js') !!}"></script>
<script src = "{!! asset('js/app.js') !!}"></script>
<script src = "{!! asset('js/bootstrap.min.js') !!}"></script>
<script src = "{!! asset('fontawesome-free-5.5.0-web/js/all.js') !!}"></script>
</body>
</html>