<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @hasSection('title')

        <title>@yield('title') - {{ config('app.name') }}</title>
    @else
        <title>{{ config('app.name') }}</title>
@endif

<!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url(mix('css/app.css')) }}">
    @livewireStyles
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
</head>

<body>

<div class="h-screen flex overflow-hidden bg-gray-100" x-data="{ sidebarOpen: false }" @keydown.window.escape="sidebarOpen = false">
    @include('admin_layout.side')
    <div class="flex flex-col w-0 flex-1 overflow-auto">
        <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
            <button @click.stop="sidebarOpen = true" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
        <div id="app">
            <x-notification/>
            <livewire:notification />

            @yield('content')
        </div>

    </div>
    <livewire:confirm-component />
</div>

<script src="{{ url(mix('js/app.js')) }}"></script>
@livewireScripts
<script src="https://unpkg.com/filepond/dist/filepond.js" ></script>

</body>
</html>
