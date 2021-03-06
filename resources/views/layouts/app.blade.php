<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} {{ config('app.version') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm ">
            <div class="container">
                <a class="navbar-brand" href="{{route('index')}}">
                    {{ config('app.name') }} <small class="text-muted">{{ config('app.version') }}</small>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item" data-content="The home screen." data-toggle="popover" data-trigger="hover" data-placement="bottom">
                            <a class="nav-link" href="{{route('index')}}">Home </a>
                        </li>
                        <li class="nav-item" data-content="View the queue of movies being added" data-toggle="popover" data-trigger="hover" data-placement="bottom">
                            {{-- {!! collect((new Radarr)->getQueue())->count() == '0' ? '' : '<sup class="badge badge-secondary">'. App\Queue::queueAmt() . '</sup>'!!} --}}

                            @php
                            $qCount = collect((new App\Radarr)->getQueue())->count();
                            @endphp

                            <a class="nav-link" href="{{route('index.queue')}}">Queue {!! ($qCount == '0') ? '' : '<sup class="badge badge-secondary">'. $qCount . '</sup>'!!}</a>
                        </li>
                        <li class="nav-item" data-content="Request a movie to be added" data-toggle="popover" data-trigger="hover" data-placement="bottom">
                            <a class="nav-link" href="{{route('index.search')}}">Search</a>
                        </li>
                        <li class="nav-item" data-content="View the weekly trending movies" data-toggle="popover" data-trigger="hover" data-placement="bottom">
                            <a class="nav-link" href="./trending">Trending</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Sign in') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->is_admin)
                                <a href="/admin" class="dropdown-item">Admin</a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>