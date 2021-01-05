@extends("base")

@section('title', 'Liste des jeux')

@section('content')

    <h1 class="text-center">Tous les jeux de la super ludotheque de l'IUT de Lens</h1>
    <div class="row">
        <div class="col-6 text-left">
            @auth
                <a class="btn btn-success" href="{{ URL::route('jeu.create') }}">Ajouter un jeu</a>
            @endauth
        </div>

        <div class="col-6 text-right">
            <a href="{{ URL::route('jeu.index', $sort) }}">Trié par nom @if ($filter !== null)<i class="fas  @if ($sort == 0)fa-sort-down @else fa-sort-up @endif "></i> @endif</a>
        </div>
    </div>
    <br>
    <div class="row ">

        @foreach ($jeux as $jeu)
            <div class="col-4">
                <div class="card">
                    <img src="{{url($jeu->url_media)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $jeu->nom }}</h5>
                        <p class="card-text">
                            {{ \Illuminate\Support\Str::limit($jeu->description, 50, $end='...') }}<br/>
                        <hr>
                        {{ $jeu->theme->nom }}
                        <hr>
                        durée : {{ $jeu->duree }}
                        <hr>
                        Nombre de joueur : {{ $jeu->nombre_joueurs }}
                        <br>
                        <a href="{{ URL::route('jeu.show', $jeu->id) }}" class="btn btn-primary">Plus d'info</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
