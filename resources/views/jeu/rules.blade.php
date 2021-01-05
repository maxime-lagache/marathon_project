@extends("base")

@section('title', 'Détail du jeu')

@section('content')

    <div class="row justify-content-center">
        <div class="col-6 ">
            <h3 class="card-title">{{ $jeu->nom }}</h3>

            {!! $jeu->regles !!}

        </div>
    </div>

    <div class="row">
        <div class="col-6 ">
            <a href="{{ URL::route('jeu.show', $jeu->id) }}" class="btn btn-primary">Retour àu jeu</a>
        </div>
        <div class="col-6 ">
            <a href="{{ URL::route('jeu.index',['sort'=>0,'page'=>1]) }}" class="btn btn-warning">Retour à la liste des jeux</a>
        </div>
    </div>
@endsection

