<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Editeur;
use App\Models\Jeu;
use App\Models\Theme;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class JeuController extends Controller
{
    /**
     * List All Jeu
     *
     * @return \Illuminate\View\View
     */
    public function index($sort = null)
    {
        $filter = null;
        if($sort !== null){
            if($sort){
                $jeux = Jeu::all()->sortBy('nom');
            } else{
                $jeux = Jeu::all()->sortByDesc('nom');
            }
            $sort = !$sort;
            $filter = true;
        } else{
            $jeux = Jeu::all();
            $sort = true;
        }
        Log::info(url($jeux[0]->url_media));
        return view('jeu.index', ['jeux' => $jeux, 'sort' => intval($sort), 'filter' => $filter]);
    }

    /**
     * Show Jeu.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $jeux = Jeu::all();

        $jeu = $jeux->find($id);

        return view('jeu.show', ['jeu' => $jeu, 'jeux' => $jeux]);
    }

    public function comment(Request $request, $id){

        $request->validate(
            [
                'note' => 'required',
                'commentaire' => 'required'
            ],
            [
                'note.required' => 'La note est requise',
                'commentaire.required' => 'Le commentaire est requise'
            ]
        );

        $comment = new Commentaire();
        $comment->note=$request->note;
        $comment->commentaire=$request->commentaire;
        $comment->date_com=new \DateTime('now');
        $comment->user_id=Auth::user()->id;
        $comment->jeu_id=$id;
        $comment->save();

        return Redirect::route('jeu.show', ['id'=>$id]);
    }


    /**
     * Show rules .
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function rules($id)
    {
        $jeux = Jeu::all();

        $jeu = $jeux->find($id);

        return view('jeu.rules', ['jeu' => $jeu]);
    }

    /**
     * Show the form to create a new jeu.
     *
     * @return Response
     */
    public function create()
    {
        return view('jeu.create');
    }

    public function search(Request $request)
    {
        return view('jeu.search');
    }
    /**
     * Store a new Jeu.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'nom' => 'required|unique:jeux',
                'description' => 'required',
                'theme' => 'required',
                'editeur' => 'required',
                'age' => 'required',
                'regle' => 'required',
                'langue' => 'required',
                'url_media' => 'required',
                'nombre_joueurs' => 'required',
                'categorie' => 'required',
                'duree' => 'required',
            ],
            [
                'nom.required' => 'Le nom est requis',
                'nom.unique' => 'Le nom doit être unique',
                'description.required' => 'La description est requise',
                'theme.required' => 'Le théme est requis',
                'editeur.required' => 'L\'editeur est requis',
                'age.required' => 'L\'age est requis',
                'regle.required' => 'Les régles du jeu sont requise',
                'url_media.required' => 'L\'url d\'une image est requise',
                'nombre_joueurs.required' => 'Le nombres de joueurs est requis',
                'categorie.required' => 'La catégorie est requis',
                'duree.required' => 'La duree est requise',
            ]
        );

        $jeu = new Jeu();
        $jeu->nom = $request->nom;
        $jeu->description = $request->description;
        $jeu->regles = $request->regle;
        $jeu->langue = $request->langue;
        $jeu->age = $request->age;
        $jeu->nombre_joueurs = $request->nombre_joueurs;
        $jeu->categorie = $request->categorie;
        $jeu->duree = $request->duree;
        $jeu->theme_id = $request->theme;
        $jeu->user_id = Auth::user()->id;
        $jeu->editeur_id = $request->editeur;
        $jeu->url_media = $request->url_media.$jeu->nom.'/200/200';

        $jeu->save();

        return Redirect::route('jeu.index');
    }


}
