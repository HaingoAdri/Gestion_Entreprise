<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Details_Besoin_Genre extends Model
{
    public $id;
    public $idBesoin;
    public $idGenre;
    public $note;
    public $typeGenre;

    public function insertDetailsBesoinGenre($idBesoin, $idGenre, $note) {
        try {
            $requete = "insert into Details_Besoin_Genre(idBesoin, idGenre, note) values (".$idBesoin.",".$idGenre.",".$note.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Besoin Genre: ".$e->getMessage());
        }    
    }

    public function getGenre($nombre){
        if($nombre == 1){
            return "Homme";
        }else if($nombre == 10){
            return "Femme";
        }
        return "";
    }

    public function getListeBesoinsGenre() {
        $requette = "select * from Details_Besoin_Genre";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Details_Besoin_Genre = new Details_Besoin_Genre();
                $Details_Besoin_Genre->id = $resultat->id;
                $Details_Besoin_Genre->idBesoin = $resultat->idBesoin;
                $Details_Besoin_Genre->idGenre = $resultat->idGenre;
                $Details_Besoin_Genre->note = $resultat->note;
                $liste[] = $Details_Besoin_Genre;
            }
        }
        return $liste;
    }

    public function getUneBesoinGenre($idbesoin) {
        $requette = "select * from Details_Besoin_Genre where idbesoin = " . $idbesoin;
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $Details_Besoin_Genre = new Details_Besoin_Genre();
                $Details_Besoin_Genre->id = $resultat->id;
                $Details_Besoin_Genre->idBesoin = $resultat->idbesoin;
                $Details_Besoin_Genre->idGenre = $resultat->idgenre;
                $Details_Besoin_Genre->note = $resultat->note;
                $Details_Besoin_Genre->typeGenre = $this->getGenre($Details_Besoin_Genre->idGenre);
                $liste[] = $Details_Besoin_Genre;
            }
        }
        return $liste;
    }

    public function note_genre_cv($idBesoin, $idGenre) {
        $note = 0;
        $listeDetails = $this->getUneBesoinGenre($idBesoin);
        foreach ($listeDetails as $genre) {
            if($idGenre == $genre->idGenre)
                $note = $genre->note;
        }
        return $note;
    }
}
