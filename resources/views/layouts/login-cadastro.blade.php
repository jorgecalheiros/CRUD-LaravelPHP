<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/a4cc31e179.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
        @yield('header')
        <x-system.lang-switch/>
    </header>

    @yield("content-form")


    <footer class="footer bg-white relative pt-1 border-b-2" style="border: 0">
        <div class="container mx-auto px-6">
            <div class="mt-16 border-t-2 border-gray-300 flex flex-col items-center" style="border: 0">
                <div class="sm:w-2/3 text-center py-6">
                    <p class="text-sm text-blue-700 font-bold mb-2">
                        ©  {{ __("misc.text.footer_title") }}
                    </p>
                </div>
            </div>
        </div>
    </footer>

        <!-- Include the Quill library -->
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

        <!-- Initialize Quill editor -->
        <script>
        var quill = new Quill('#quillEditor', {
            theme: 'snow'
        });
        </script>
</body>

</html>
