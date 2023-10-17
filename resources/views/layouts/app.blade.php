<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
         body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            background-size: cover;
            background-position: center;
        }
        #text{
            font-size:20px
        }

        div{
            font-size:17px
        }
        #app {
            flex: 1;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
    .logo-image {
        width: 60px;
        height: 60px;
        margin-right: 5px;
        transition: transform 0.3s;
    }

        .logo-image:hover {
            transform: scale(3.0);
            cursor: pointer;
        }
    </style>
</head>

<body style="background-image: url('{{ asset('storage/kota-medan.jpeg')}}');">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index_product') }}">
                <img src="{{ asset('storage/logo.png') }}" alt="Logo" class="logo-image" >
                
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    
                                    @if (Auth::user()->is_admin)
                                        <a class="dropdown-item" href="{{ route('create_product') }}">
                                            Create Product
                                        </a>

                                        <a class="dropdown-item" href="{{ route('paidOrder') }}">
                                            Order Confirmation
                                        </a>



                                    @else
                                        <a class="dropdown-item" href="{{ route('show_cart') }}">
                                            Cart
                                        </a>
                                    @endif
                                    

                                    <a class="dropdown-item" href="{{ route('index_order') }}">
                                        Order
                                    </a>
                                    <a class="dropdown-item" href="{{ route('show_profile') }}">
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            if (confirm('Apakah Anda yakin ingin logout?')) {
                                                document.getElementById('logout-form').submit();
                                            }">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
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

    <footer>
    <p>&copy; 2023 SecondStore. All rights reserved.</p>
    </footer>
</body>

</html>
