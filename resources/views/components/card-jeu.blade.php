<div class="py-6">
    <div class="flex w-full bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="w-1/3 bg-cover"
             style="background-image: url({{url($jeu->url_media)}})">
        </div>
        <div class="w-2/3 p-4">
            <h1 class="text-gray-900 font-bold text-2xl">{{$jeu->nom}}</h1>
            <p class="mt-2 text-gray-600 text-sm">{{substr($jeu->description,0, 50)}} @if (strlen($jeu->description) > 50)
                    ... @endif</p>
            <p class="m-0"><i class="fas fa-clock pr-2"></i>{{$jeu->duree}}</p>
            <p><i class="fas fa-users pr-2"></i>{{$jeu->nombre_joueurs}}</p>
            <p class="m-0"><span class="text-gray-800  font-bold">Thème : </span>{{$jeu->theme->nom}}</p>
            <p class="m-0"><span class="text-gray-800  font-bold">Editeur : </span>{{$jeu->editeur->nom}}</p>
            <p class="m-0"><span class="text-gray-800  font-bold">Catégorie : </span>{{$jeu->categorie}}</p>
            <p><span class="text-gray-800  font-bold">Age : </span>{{$jeu->age}}</p>
            <div class="px-6 py-4">
                @foreach($jeu->mecaniques as $mecanique)
                    <span class="inline-block bg-yellow-200 rounded-full px-3 py-1 text-sm font-semibold text-grey-900 mr-2">
                        {{$mecanique->nom}}
                    </span>
                @endforeach
            </div>
            <div class="flex item-center justify-between mt-3">
                <h1 class="text-gray-700 font-bold text-xl"> Note moyenne :</h1>
                <a type="button"
                   class="px-3 py-2 bg-gray-800 text-white text-xs font-bold uppercase rounded"
                   href="{{route('jeu.show', ['id' => $jeu->id])}}">Voir les détails</a>
            </div>
        </div>
    </div>
</div>
