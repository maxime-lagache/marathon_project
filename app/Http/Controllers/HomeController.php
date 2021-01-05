<?php

namespace App\Http\Controllers;


use App\Models\Jeu;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller {
    function cinqAleatoires() {
        $jeu_ids = Jeu::all()->pluck('id');
        $faker = \Faker\Factory::create();
        $ids = $faker->randomElements($jeu_ids->toArray(), 5);
        $jeux = [];
        foreach ($ids as $id) {
            $jeux[] = Jeu::find($id);
        }
        return view('marathon_accueil', ['jeux' => $jeux]);
    }

    function cinqMeilleurs() {
        $jeux = Jeu::all();
        $tabNotejeux = [0,0,0,0,0];
        $tabjeux = [];

        for($i=0; $i<count($tabNotejeux); $i++){
            foreach ($jeux as $jeu){
                if (($jeu->noteAvg($jeu->id) > $tabNotejeux[$i]) && !in_array($jeu, $tabjeux)) {
                    $tabNotejeux[$i] = $jeu->noteAvg($jeu->id);
                    $tabjeux[$i] = Jeu::find($jeu->id);
                }
            }
        }
        return view('marathon_accueil_5meilleurs', ['tabjeux' => $tabjeux]);
    }

    /**
     * home Page
     *
     * @return \Illuminate\View\View
     */
    public function index() {
        $users = User::all();

        return view('home.index', ['users' => $users]);
    }
}
