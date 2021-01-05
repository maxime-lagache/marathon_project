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
</head>
<body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
<div class="h-screen w-full flex">
    {{-- navbar --}}
    @include('base.navbar')

    {{-- content --}}
    @yield('content', 'En Attente d\'un contenu')
    {{-- ajoute les scripts javascript pour bootstrap --}}
    @section('scripts')
        <script src="{{ asset('js/app.js')}}"></script>
@show
</body>
</html>
