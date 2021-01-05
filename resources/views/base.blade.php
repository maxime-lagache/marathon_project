<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="iut Lens">
    <title>@yield('title', 'Base LaraVel')</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/starter-template/">

    <!-- Bootstrap core CSS -->
{{--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
--}}

<!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        body{
            background: mediumpurple;
        }
        nav{
            background: rebeccapurple;
        }
    </style>
</head>
<body style="padding-top: 50px;" >

@section('navbar')
    <nav class="navbar navbar-expand-md fixed-top">
        <a class="navbar-brand" href="{{ URL::route('home') }}"><span class="text-2xl pl-2"><i class="fa fa-home"></i> IUT Lens</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ URL::route('dashboard') }}">dashboard</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ URL::route('jeu.index') }}">Jeux</a>
                </li>

            </ul>
            <ul class="my-2 my-lg-0 navbar-nav">
                @guest
                    <li class="my-2 my-sm-0"><a class="btn btn-success" href="{{ URL::route('login') }}">Login</a></li>
                @endguest
                @auth
                        <li class="my-2 my-lg-0"><!-- Authentication --><a class="nav-link" href="{{URL::route('profile.profil',Auth::user()->id)}}">{{ Auth::user()->name }}</a>
                        <form  method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-jet-dropdown-link>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>
@show


<main role="main" class="container">

    <div class="starter-template" style="padding-top: 40px;">

        @yield('content')

    </div>

</main>

@section('js')
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
@show

</body>
</html>
