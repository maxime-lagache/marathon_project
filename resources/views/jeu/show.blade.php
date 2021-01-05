@php use Illuminate\Support\Facades@endphp

@extends("base")

@section('title', 'Détail du jeu')

<style>
    #progress {
        text-align: center;
    }

    #progress_user{
        text-align: center;
        font-weight: bold;
    }

    #progress_user div {
        display: block;
    }

    #progress label {
        margin-left: 5px;
        margin-right: 5px;
    }

    .progress_circle_user {
        text-align: center;
    }

    progress {
        position: relative;
    }

    #progress progress:after {
        content : ' ';
        background-image: url("{{asset("images/arrow.svg")}}");
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        width: 10px;
        height: 10px;
        position: absolute;
        bottom: -10px;
        @php
        $pourcentage = $jeu->valueProgress() / $jeu->maxProgress() * 100
        @endphp
        left: {{$pourcentage}}%;
        transform: translate(-{{$pourcentage}}%,0);
    }

</style>
@section('content')

        @if ($jeu->noteAvg($jeu->id) <= 1)
            <style type="text/css">#chiffre1{color:rgb(255,0,0);}</style>
        @elseif ($jeu->noteAvg($jeu->id) <= 2)
            <style type="text/css">#chiffre1{color:rgb(192,64,0);}</style>
        @elseif ($jeu->noteAvg($jeu->id) <= 3)
            <style type="text/css">#chiffre1{color:rgb(128,128,0);}</style>
        @elseif ($jeu->noteAvg($jeu->id) <= 4)
            <style type="text/css">#chiffre1{color:rgb(64,192,0);}</style>
        @else
            <style type="text/css">#chiffre1{color:rgb(0,255,0);}</style>
        @endif


        @if ($jeu->noteMax($jeu->id) <= 1)
            <style type="text/css">#chiffre2{color:rgb(255,0,0);}</style>
        @elseif ($jeu->noteMax($jeu->id) <= 2)
            <style type="text/css">#chiffre2{color:rgb(192,64,0);}</style>
        @elseif ($jeu->noteMax($jeu->id) <= 3)
            <style type="text/css">#chiffre2{color:rgb(128,128,0);}</style>
        @elseif ($jeu->noteMax($jeu->id) <= 4)
            <style type="text/css">#chiffre2{color:rgb(64,192,0);}</style>
        @else
            <style type="text/css">#chiffre2{color:rgb(0,255,0);}</style>
        @endif

        @if ($jeu->noteMin($jeu->id) <= 1)
            <style type="text/css">#chiffre3{color:rgb(255,0,0);}</style>
        @elseif ($jeu->noteMin($jeu->id) <= 2)
            <style type="text/css">#chiffre3{color:rgb(192,64,0);}</style>
        @elseif ($jeu->noteMin($jeu->id) <= 3)
            <style type="text/css">#chiffre3{color:rgb(128,128,0);}</style>
        @elseif ($jeu->noteMin($jeu->id) <= 4)
            <style type="text/css">#chiffre3{color:rgb(64,192,0);}</style>
        @else
            <style type="text/css">#chiffre3{color:rgb(0,255,0);}</style>
        @endif

        <style>
            @if($jeu->classement <= 3)
                        .burn:after{
                    content : ' ';
                    background-image: url("{{asset("images/fire.svg")}}");
                    background-size: contain;
                    background-repeat: no-repeat;
                    width: 200px;
                    height: 200px;
                    position: absolute;
                    display: inline;
            }

            @elseif($jeu -> classement >3 && $jeu -> classement <8)
                        .burn:after{
                content : ' ';
                background-image: url("{{asset("images/fire.svg")}}");
                background-size: contain;
                background-repeat: no-repeat;
                width: 100px;
                height: 100px;
                position: absolute;
                display: inline;
            }
            @elseif($jeu -> classement > 7)
                        .burn:after{
                content : ' ';
                background-image: url("{{asset("images/fire.svg")}}");
                background-size: contain;
                background-repeat: no-repeat;
                width: 50px;
                height: 50px;
                position: absolute;
                display: inline;
            }
            @endif
        </style>

    <div class="row justify-content-center">
        <div class="col-6 ">
            <div class="card">
                <img src="{{ url($jeu->url_media) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"> <b>Nom du jeu :</b> {{ $jeu->nom }}</h5>
                    <p class="card-text">
                        <b>Description:</b> <br>{{ $jeu->description }}
                    <hr>
                    <b>Thème :</b>
                    {{ $jeu->theme->nom }}
                    <hr>
                    <b>Mécanique :</b> <br>
                    @foreach ( $jeu->mecaniques as $key => $mecaniques)
                        @if ($key !== 0)
                            &nbsp;-&nbsp;
                        @endif
                        {{ $mecaniques->nom }}
                    @endforeach
                    <hr>
                    <b>Catégorie :</b>
                    {{ $jeu->categorie }}
                    <hr>
                    <b>Age recommandé :</b> <br>{{ $jeu->age }}
                    <hr>
                    <b>Langue :</b> <br>
                    {{ $jeu->langue }}
                    <hr>
                    <b>Edité par :</b> <br> {{ $jeu->editeur->nom }}
                    <hr>
                    <b>durée :</b> <br> {{ $jeu->duree }}
                    <hr>
                    <b>Nombre de joueur :</b> <br> {{ $jeu->nombre_joueurs }}
                    <hr>
                    <!-- FIX 30 -->

                    <span style="text-decoration: underline;font-weight: bold;">Statistiques :</span><br>
                    Note moyenne : <span id="chiffre1" style="font-weight: bold">{{$jeu->noteAvg($jeu->id)}}</span><br>
                    Note maximale : <span id="chiffre2" style="font-weight: bold">{{$jeu->noteMax($jeu->id)}}</span><br>
                    Note minimale : <span id="chiffre3" style="font-weight: bold">{{$jeu->noteMin($jeu->id)}}</span><br><br>
                    <p class="burn">Classement de ce jeu : {{$jeu->classement}} / {{count($jeux)}}</p>

                    <br><br>
                    <span style="text-decoration: underline;font-weight: bold">Tarifs :</span><br>
                    {{$jeu->prixMoyen()}}<br>
                    {{$jeu->prixMax()}}<br>
                    {{$jeu->prixMin()}}<br><br>
                    {{$jeu->nbUsers($jeu->id)}}<br>
                    - Utilisateurs : @php echo DB::table('achats')->distinct()->count('*');@endphp<br>
                    <hr>

                    <div id="progress">
                        <label for="file" style="font-weight: bold">Tarif du jeu: </label> <br>

                        <label for="prix_bas">{{$jeu->prixMinValue()}}</label><progress id="file" max="{{$jeu->prixMaxValue() - $jeu->prixMinValue()}}" value="{{$jeu->prixAvg() - $jeu->prixMinValue()}}"> {{$jeu->prixAvg()}}
                        </progress>
                        <label for="prix_haut">{{$jeu->prixMaxValue()}}</label> <br>
                        <label for="prix_moyen">{{$jeu->prixMoyen()}}</label>
                    </div>
                    <hr>
                    <div style="text-align: center">
                        <label id="progress_user" for="progress-circle">Nombre d'utilisateurs :</label> <br>
                        <progress class="progress-circle" id="file" max="100" value="{{round((DB::table('achats')->where('jeu_id',$jeu->id)->count('*') / DB::table('achats')->distinct()->count('*'))*100,0)}}"> {{round((DB::table('achats')->where('jeu_id',$jeu->id)->count('*') / DB::table('achats')->distinct()->count('*'))*100,0)}}
                        </progress>
                        <br>
                        <label for="percentage">{{round((DB::table('achats')->where('jeu_id',$jeu->id)->count('*') / DB::table('achats')->distinct()->count('*'))*100,0)}} %</label>

                    </div>

                    <hr>
                    <form method="post" action="{{ URL::route('jeu.comment', $jeu->id) }}">
                        @csrf
                        <p style="padding: 10px 0 0 10px">Votre note du jeu :<br>
                            <label for="note-0"><input type="radio" name="note" value="0" id="note-0" /> 0</label>
                            <label for="note-1"><input type="radio" name="note" id="note-1" value="1" /> 1</label>
                            <label for="note-2"><input type="radio" name="note" id="note-2" value="2" /> 2</label>
                            <label for="note-3"><input type="radio" name="note" id="note-3" value="3 "/> 3</label>
                            <label for="note-4"><input type="radio" name="note" id="note-4" value="4" /> 4</label>
                            <label for="note-5"><input type="radio" name="note" id="note-5" value="5" /> 5</label></p>

                        <textarea name="commentaire" rows="8" cols="45" style="border: 2px solid black" placeholder="Votre commentaire ici..."></textarea>
                        <br><br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </p>
                    </form>
                        <hr>


                    <span style="text-decoration: underline;font-weight: bold; font-size: 25px;">Commentaires : </span><br>
                    <div>
                        <ul>
                            @foreach($jeu->commentaires as $commentaire)
                                <li><br>
                                    <span>Auteur : {{$commentaire->user->name}}</span><br>
                                    <span>Date : {{$commentaire->date_com}} </span><br>
                                    <span>Texte : {{$commentaire->commentaire}}</span><br>
                                    <span>Note : <span id="chiffreCom" style="font-weight: bold"> </span></span>
                                    @if ($commentaire->note > 0)
                                        @for($i = 0; $i < $commentaire->note; $i++)
                                            <i style="color: #ffb800" class="fas fa-star"></i>
                                        @endfor
                                    @else
                                        {{$commentaire->note}}
                                    @endif
                                </li>
                                <hr>
                            @endforeach
                        </ul>
                    </div>

                    </p>
                    </p>
                        <a href="{{ URL::route('jeu.rules', $jeu->id) }}" class="btn btn-primary">Regarder les régles du jeu</a>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ URL::route('jeu.index',['sort'=>0,'page'=>1]) }}" class="btn btn-secondary">Retour à la liste des jeux</a>
@endsection


