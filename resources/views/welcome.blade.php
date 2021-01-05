<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">

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

<body  >
<!--Nav-->
    <nav class="navbar navbar-expand-md fixed-top" > <!-- Add this to make the nav fixed: "fixed z-10 top-0" -->
        <div class="container mx-auto flex flex-wrap items-center">
            <div class="flex w-full md:w-1/2 justify-center md:justify-start text-white font-extrabold">
                <p class="text-white no-underline hover:text-white hover:no-underline" href="#">
                    <span class="text-2xl pl-2"><img src="{{asset("images/logo_projetMarathon.png")}}" style="width: 50px; display: inline"> NavGames </span>
                </p>
            </div>
            <div class="flex w-full pt-2 content-center justify-between md:w-1/2 md:justify-end">
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    <a href="{{ URL::route('jeu.index',['sort'=>0,'page'=>1]) }}" class="text-white no-underline hover:text-gray-200 hover:text-underline py-2 px-4">jeux</a>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-white no-underline hover:text-gray-200 hover:text-underline py-2 px-4">Dashboard</a>

                    @else
                        <a href="{{ route('login') }}" class="text-white no-underline hover:text-gray-200 hover:text-underline py-2 px-4">Connexion</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-white no-underline hover:text-gray-200 hover:text-underline py-2 px-4">Enregistrement</a>
                        @endif
                    @endauth
                </div>

            </div>
        </div>
    </nav>


    <!--Hero-->
    <div class="container mx-auto flex flex-col md:flex-row items-center my-12 md:my-24">
        <!--Left Col-->
        <div class="flex flex-col w-full lg:w-1/2 justify-center items-start pt-12 pb-24 px-6">
            <p class="uppercase tracking-loose">IUT de Lens - Département Informatique</p>
            <h1 class="font-bold text-3xl my-4">Ludothèque</h1>
            <p class="leading-normal mb-4">Projet Marathon 2020 élaboré à l'aide de <a href="https://laravel.com/"> Laravel</a>.</p>
{{--
            <a type="button" href="http://www.cril.univ-artois.fr/~hemery/enseignement/An20-21/m3104/index.html" class="bg-transparent hover:bg-gray-900 text-gray-900 hover:text-white rounded shadow hover:shadow-lg py-2 px-4 border border-gray-900 hover:border-transparent">Enoncé</a>
--}}
        </div>
        <!--Right Col-->
        <div class="w-full lg:w-1/2 lg:py-6 text-center">
            <img src="{{url('./images/ludotheque.svg')}}" width="800px">
            <!--Add your product image here-->
{{--
            <svg class="fill-current text-gray-900 w-3/5 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M17 6V5h-2V2H3v14h5v4h3.25H11a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6zm-5.75 14H3a2 2 0 0 1-2-2V2c0-1.1.9-2 2-2h12a2 2 0 0 1 2 2v4a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-5.75zM11 8v8h6V8h-6zm3 11a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>
--}}
        </div>

    </div>

@section('scripts')
    <script src="{{ asset('js/main.js')}}"></script>
    <script src="{{ asset('js/app.js')}}"></script>
@show

</body>
</html>
