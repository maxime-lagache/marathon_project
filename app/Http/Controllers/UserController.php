<?php

namespace App\Http\Controllers;

use App\Models\Jeu;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function profil($id)
    {
        $users= User::all();

        $user= $users->find($id);
        return view('profile.profil',['user'=>$user]);
    }

    public function storeAchat(Request $request)
    {

        $request->validate(
            [
                'jeu_id' => 'required',
                'date_achat' => 'required',
                'lieu' => 'required',
                'prix' => 'required',
            ],
            [
                'jeu_id.required' => 'Le jeu est requis',
                'date_achat.required' => 'La date est requise',
                'lieu.required' => 'Le lieu est requis',
                'prix.required' => 'Le prix est requis',
            ]
        );

        $user = Auth::user();

        $user->ludo_perso()->attach($request->jeu_id, ['lieu' => $request->lieu,
            'prix' => $request->prix,
            'date_achat' => $request->date_achat]);

        $user->save();

        return Redirect::route('jeu.index');
    }

    public function destroyAchat(Request $request, Jeu $jeu){
        if ($request->delete == 'valide') {
            $user = Auth::user();
            $user->ludo_perso()->detach($jeu->id);
            $user->save();
            return redirect()->route('jeu.show');
        }
        return redirect()->route('jeu.show', $jeu->id);
    }
}
