@include('_layouts.defines')

<!document html>
<html lang="pt-br">
    <head>
        <title>@yield('title')</title>
        @stack('styles')
        @stack('metas')
    </head>
    <body>     
        <nav class="navbar  navbar-expand-lg  navbar-dark bg-primary ">
            <a class="navbar-brand" href="#">@yield('title')</a>
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product.index') }}">Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('category.index') }}">Categorias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('product.index') }}">Produtos</a>
                </li>
            </ul>
        </nav>
        <div class="container">
            @yield('content')
        </div>
        @stack('scripts')
    </body>
</html>