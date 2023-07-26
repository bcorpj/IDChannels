<!doctype html>
<html class="h-full bg-white" lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Application' }}</title>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/499416/TweenLite.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/499416/EasePack.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/features/animation/background.js'])
</head>
<body class="h-full m-0 p-0 overflow-hidden">
    <canvas id="background-canvas" class="absolute top-0 left-0 z-0"></canvas>
    {{ $slot }}
</body>
</html>
