<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FocusFlow</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,100..900;1,100..900&family=BenchNine:wght@300;400;700&family=Londrina+Solid:wght@100;300;400;900&family=Monomaniac+One&display=swap"
        rel="stylesheet">
    @vite('resources/js/app.js')
    @inertiaHead

    <style>
        body {
            user-select: none;
        }
    </style>
</head>

<body style="margin: 0 !important; padding: 0 !important;" class="dark:bg-zinc-950">
    @inertia
</body>

</html>
