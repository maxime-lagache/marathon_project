@extends("base")

@section('title', 'Home Page')

@section('content')

    <hr>
    <h1 class="text-center">Bienvenue sur la super ludotheque de l'IUT de Lens</h1>
    <hr>

    <ul>
        <li>Liste d'utilisateur</li>
    @foreach ($users as $user)

            <li>{{ $user->name }} - {{ $user->email }} - mp : {{ $user->name }}</li>

    @endforeach
    </ul>

@endsection
