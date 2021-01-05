<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class Jeu extends Model {
    use HasFactory;

    protected $table = 'jeux';
    public $timestamps = false;

    protected $fillable = ['nom', 'description', 'regles', 'langue',
        'url_media', 'age', 'nombre_joueurs', 'categorie', 'duree'];

    function createur() {
        return $this->belongsTo(User::class);
    }

    function theme() {
        return $this->belongsTo(Theme::class);
    }

    function editeur() {
        return $this->belongsTo(Editeur::class);
    }

    function mecaniques() {
        return $this->belongsToMany(Mecanique::class, 'avec_mecaniques');
    }

    function acheteurs() {
        return $this->belongsToMany(User::class, 'achats')
            ->as('achat')
            ->withPivot('prix', 'lieu', 'date_achat');
    }

    function users() {
        return $this->belongsToMany(User::class, 'users')
            ->as('users');
    }

    function commentaires() {
        return $this->hasMany(Commentaire::class);
    }

    static function nbJeux(){
        return (new static)::count('*');
    }
    static function getJeux($deb,$fin){
        return (new static)::whereBetween('nom',[$deb,$fin]);
    }

    function prixMoyen() {
        $sum = 0;
        $nb = 0;
        foreach ($this->acheteurs as $acheteur){
            if (isset($acheteur->achat->prix)){
                $sum+= $acheteur->achat->prix;
                $nb++;
            }
        }
        if ($nb!=0){
            return sprintf("Prix moyen : %6.2f €", $sum/$nb);
        } else {
            return "Pas de prix moyen.";
        }
    }

    function prixAvg() {
        $sum = 0;
        $nb = 0;
        foreach ($this->acheteurs as $acheteur){
            if (isset($acheteur->achat->prix)){
                $sum+= $acheteur->achat->prix;
                $nb++;
            }
        }
        if ($nb!=0){
            return ($sum/$nb);
        } else {
            return 0;
        }
    }


    function prixMax(){
        $res = 0;
        foreach($this->acheteurs as $acheteur)
            if (isset($acheteur->achat->prix) and $acheteur->achat->prix > $res)
                $res = $acheteur->achat->prix;
        if ($res != 0) return sprintf("Prix maximal : %6.2f €",$res);
        return "Pas de prix maximal.";
    }

    function prixMaxValue(){
        $res = 0;
        foreach($this->acheteurs as $acheteur)
            if (isset($acheteur->achat->prix) and $acheteur->achat->prix > $res)
                $res = $acheteur->achat->prix;
        if ($res != 0) return $res;
        return 0;
    }
    function prixMin(){
        $res = 90000;
        foreach($this->acheteurs as $acheteur)
            if (isset($acheteur->achat->prix) and $acheteur->achat->prix < $res)
                $res = $acheteur->achat->prix;
        if ($res != 0) return sprintf("Prix minimal : %6.2f €",$res);
        return "Pas de prix minimal.";
    }

    function nbUsers($id){
        $res = 0;
        $doublons = [];
        foreach($this->acheteurs as $acheteur) {
            if (isset($acheteur->achat->user_id) and !in_array($acheteur->achat->user_id,$doublons) ){
                $res++;
                array_push($doublons,$acheteur->achat->user_id);
            }
        }
        return "Total des utilisateurs : ".$res;
    }

    function noteAvg($id){
        return round(DB::table('commentaires')->where('jeu_id',$id)->avg('note'),2);
    }
    function noteMax($id){
        return round(DB::table('commentaires')->where('jeu_id',$id)->max('note'),2);
    }
    function noteMin($id){
        return round(DB::table('commentaires')->where('jeu_id',$id)->min('note'),2);
    }
    function prixMinValue(){
        $res = 90000;
        foreach($this->acheteurs as $acheteur)
            if (isset($acheteur->achat->prix) and $acheteur->achat->prix < $res)
                $res = $acheteur->achat->prix;
        if ($res != 0) return $res;
        return 0;
    }

    function maxProgress() {
        return ($this->prixMaxValue() - $this->prixMinValue());
    }

    function valueProgress() {
        return ($this->prixAvg() - $this->prixMinValue());
    }
}
