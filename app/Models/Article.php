<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Article extends Model
{
    public $id;
    public $article;

    public function __construct($id = "", $article = "") {
        $this->id = $id;
        $this->article = $article;
    }

    public function insert() {
        try {
            $requete = "insert into article values ('".$this->id."','".$this->article."')";
            DB::insert($requete);
            $dernierBesoinId = DB::getPdo()->lastInsertId();
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Besoin: ".$e->getMessage());
        }    
    }

    public function getListeArticle() {
        $requette = "select * from article order by article";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $article = new Article($resultat->id, $resultat->article);
                $liste[] = $article;
            }
        }
        return $liste;
    }

    public function getDonneesUnArticle() {
        $requette = "select * from article where id = '$this->id'";
        $reponse = DB::select($requette);
        $article = null;
        if(count($reponse) > 0){
            $article = new Article($reponse[0]->id, $reponse[0]->article);
        }
        return $article;
    }
}
