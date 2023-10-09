<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Besoin extends Model
{
    public $id;
    public $idPoste;
    public $idService;
    public $besoin_horaire;
    public $heure_jour_homme;

    public function insertBesoin($idPoste, $idService, $besoin_horaire, $heure_jour_homme) {
        try {
            $requete = "insert into besoin(idPoste, idService, besoin_horaire, heure_jour_homme) values (".$idPoste.",".$idService.",'".$besoin_horaire."','".$heure_jour_homme."')";
            DB::insert($requete);
            // Obtenez l'ID généré automatiquement
            $dernierBesoinId = DB::getPdo()->lastInsertId();

            // Utilisez l'ID pour récupérer le besoin complet
            $dernierBesoin = DB::table('besoin')->find($dernierBesoinId);

            Session::put('dernier_besoin', $dernierBesoin);
            // var_dump($dernierBesoin);


        } catch (Exception $e) {
            throw new Exception("Impossible to insert Besoin: ".$e->getMessage());
        }    
    }

    public function getListeBesoins() {
        $requette = "select * from besoin";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $besoin = new Besoin();
                $besoin->id = $resultat->id;
                $besoin->idPoste = $resultat->idPoste;
                $besoin->besoin_horaire = $resultat->besoin_horaire;
                $besoin->heure_jour_homme = $resultat->heure_jour_homme;
                $liste[] = $besoin;
            }
        }
        return $liste;
    }

    public function getUneBesoin($id) {
        $requette = "select * from besoin where id = " . $id;
        $reponse = DB::select($requette);
        $besoin = null;
        if(count($reponse) > 0) {
            $besoin = new Besoin();
            $besoin->id = $reponse->id;
            $besoin->idPoste = $reponse->idPoste;
            $besoin->besoin_horaire = $reponse->besoin_horaire;
            $besoin->heure_jour_homme = $reponse->heure_jour_homme;
        }
        return $besoin;
    }

    // ANNONCE
    // public function create_annonce(){

    // }
}
