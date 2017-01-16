<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/uikit.gradient.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="uk-grid">
<header class="uk-width-1-1">
    <nav class="uk-navbar">
        <a href="/" class="logo">
            <i class="uk-icon-button uk-icon-flash"></i>
        </a>
        <div class="uk-navbar-flip">
            <ul class="uk-navbar-nav">
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="uk-parent" data-uk-dropdown="{pos:'bottom-right'}">
                        <a href="">{{ Auth::user()->name }}</a>
                        <div class="uk-dropdown">
                            <ul class="uk-nav uk-nav-navbar">
                                <li>
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
    @include('layouts.preload')
</header>
<aside class="uk-width-1-5" >
    @include('layouts.sidebar')
</aside>
<main class="uk-width-4-5">
    @yield('content')
</main>
@include('layouts.scripts')
</body>
</html>
