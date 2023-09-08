<!doctype html>
<html class="h-full bg-white" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Application' }}</title>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/499416/TweenLite.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/499416/EasePack.min.js"></script>
    @filamentStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>
<body class="h-full m-0 p-0 overflow-hidden">
    <canvas id="background-canvas" class="absolute top-0 left-0 z-0"></canvas>
    {{ $slot }}
    @livewire('notifications')
    @filamentScripts
    <script type="module">
        import startBackground from '{{ Vite::asset('resources/js/features/animation/background.js') }}'
        startBackground()
    </script>
</body>
</html>
