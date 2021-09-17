<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/a4cc31e179.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <script src="{{ asset('/js/app.js') }}" defer></script>

    <!-- Styles -->
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #F0F2F5;
        }
    </style>
</head>

<body class="antialiased">
    <header>
        <x-system.lang-switch/>
    </header>
    @yield("content-form")
    <footer class="footer-cadastro-login">
        {{ __("misc.text.footer_title") }}
    </footer>
</body>

</html>
