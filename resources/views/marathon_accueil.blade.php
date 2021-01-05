@extends('base')

@section('content')
    <a class="btn btn-success" href="{{ URL::route('dashboard.5meilleurs') }}">Voir les 5 meilleurs jeux</a>
    <main class="flex-1 bg-gray-200 dark:bg-gray-900 overflow-y-auto transition duration-500 ease-in-out w-">
        <div class="px-24 py-12 text-gray-700 dark:text-gray-500 transition duration-500 ease-in-out">
            <h2 class="text-4xl font-medium capitalize">Cing jeux aléatoires</h2>
            <div class=" border dark:border-gray-700 transition duration-500 ease-in-out"></div>
            <div class="flex flex-col mt-2">
                @foreach($jeux as $jeu)
                    <x-card-jeu :jeu="$jeu"></x-card-jeu>
                @endforeach
            </div>
        </div>
    </main>

@endsection
