@php use App\Models\Jeu;@endphp

@extends("base")

@section('title', 'Liste des jeux')

@section('content')

    <h1 class="text-center">Tous les jeux de la super ludotheque de l'IUT de Lens</h1>
    <h2 class="text-center">Page n°{{$numPage = Request::route('page') }}</h2>
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
    <div class="row justify-content-center">
        <ul class="list-group list-group-horizontal">
            @for($i=1;$i<=Jeu::nbJeux()/15;$i++)
                <li class="list-group-item">
                    <a href="{{URL::route('jeu.index',['sort'=>0,'page'=>$i])}}">
                    {{$i}}
                    </a>
                </li>
            @endfor
        </ul>
    </div>
    <br>
    <div class="row">
            @foreach($jeux as $jeu)

               @if($jeu->id > ($numPage-1)*15 and $jeu->id < $numPage*15+1) {{-- 1-15 / 16-30 / 31-45 / ... --}}
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
            @endif
            @endforeach
        {{--@endfor--}}

    </div>
@endsection
