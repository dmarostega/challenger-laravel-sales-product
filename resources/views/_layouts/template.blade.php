@include('_layouts.defines')

<!document html>
<html lang="pt-br">
    <head>
        <title>@yield('title')</title>
        @stack('styles')
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
        @stack('scripts')
    </body>
    <footer>

    </footer>
</html>