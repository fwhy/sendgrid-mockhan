<!doctype html>
<html lang="{{ env('APP_LOCALE', 'en') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sendgrid Mockhan</title>
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
@include('_header')
<main class="@yield('container') mt-13">
    <article class="grid">@yield('content')</article>
</main>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
