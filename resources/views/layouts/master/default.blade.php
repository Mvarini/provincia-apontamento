<!doctype html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Apontamento</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />

    @vite('resources/scss/app.scss')
</head>
<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
<div class="app-wrapper">

@include('layouts.parts.header')

@include('layouts.parts.sidebar')

    <main class="app-main">

        @yield('content-header')

        <div class="app-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

    </main>

@include('layouts.parts.footer')
</div>

@vite('resources/js/app.js')
</body>
</html>


