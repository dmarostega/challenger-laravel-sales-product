@include('_layouts.defines')

<!document html>
<html lang="pt-br">
    <head>
        <title>@yield('title')</title>
        @stack('styles')
        @stack('metas')
    </head>
    <body>     
        <nav class="navbar  navbar-expand-lg  navbar-dark bg-primary shadow-sm">
            <a class="navbar-brand" href="{{ route('init') }}">@yield('title')</a>
            @guest
          
            @else
                <ul class="navbar-nav  mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('order.index') }}">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('category.index') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product.index') }}">Products</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">Users</a>
                    </li>

                </ul>
            @endguest

            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <a href="{{ route('logger.index') }}"  class="dropdown-item"  > 
                               {{ __('My Logs!')}}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </nav>
        <div class="container py-4">
            @yield('content')
        </div>
        @stack('scripts')
    </body>
</html>