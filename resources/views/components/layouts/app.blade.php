<!doctype html>
<html class="h-full bg-white" lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Application' }}</title>
    @filamentStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>
<body class="h-full">
    <livewire:components.molecules.sidebar-padded />
    <div class="md:pl-64">
        <div class="mx-7 flex flex-col md:px-8 xl:px-0">
            <livewire:components.molecules.top-bar />

            <main class="flex-1">
                <div class="py-6">
                    <div class="px-4 sm:px-6 md:px-0">
                        <h1 class="text-2xl font-semibold text-gray-600">{{ $title ?? 'Application' }}</h1>
                    </div>
                    <div class="px-4 sm:px-6 md:px-0">
                        <!-- Replace with your content -->
                        <div class="py-4">
                            {{ $slot }}
                        </div>
                        <!-- /End replace -->
                    </div>
                </div>
            </main>
        </div>
    </div>
    @filamentScripts
</body>
</html>
