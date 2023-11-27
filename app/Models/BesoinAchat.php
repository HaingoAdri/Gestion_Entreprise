<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;

//  id | idmodule | idarticle | nombre | date | etat
class BesoinAchat extends Model
{
    public $id;
    public $idModule;
    public $idArticle;
    public $nombre;
    public $date;
    public $etat;

    public function __construct($id = "", $idModule = "", $idArticle = "", $nombre = "", $date = "", $etat = "") {
        $this->id = $id;
        $this->idModule = $idModule;
        $this->idArticle = $idArticle;
        $this->nombre = $nombre;
        $this->date = $date;
        $this->etat = $etat;
    }

    public function insert() {
        try {
            $requete = "insert into besoin_achat(idmodule, idarticle, nombre, date, etat) values (".$this->idModule.",'".$this->idArticle."', '".$this->nombre."', '".$this->date."', '".$this->etat."')";
            DB::insert($requete);
            $dernierBesoinId = DB::getPdo()->lastInsertId();
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Besoin: ".$e->getMessage());
        }    
    }

    public function getListeBesoinNonValide() {
        $requette = "select * from besoin_achat where etat = 28";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $besoin = new BesoinAchat($resultat->id, $resultat->idModule, $resultat->idArticle, $resultat->nombre, $resultat->date, $resultat->etat);
                $liste[] = $besoin;
            }
        }
        return $liste;
    }
}
