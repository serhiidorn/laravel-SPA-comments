<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SPA-Comments Application</title>
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
</head>
<body class="h-100">
    <div id="app" class="h-100"></div>
</body>
</html>
