<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Type_Contrat extends Model
{
    public $id;
    public $nom;
    public $acronyme;

    public function __construct($nom = "", $acronyme = "") {
        $this->nom = $nom;
        $this->acronyme = $acronyme;
    }

    public function insertType_Contrat() {
        try {

            $requete = "insert into type_contrat(nom, acronyme) values ('".$this->nom."','".$this->acronyme."')";
            DB::insert($requete);

        } catch (Exception $e) {
            throw new Exception("Impossible to insert Type_Contrat: ".$e->getMessage());
        }    
    }

    public function getListeTypeContrats() {
        $requette = "select * from Type_contrat";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $type_contrat = new Type_Contrat();
                $type_contrat->id = $resultat->id;
                $type_contrat->nom = $resultat->nom;
                $type_contrat->acronyme = $resultat->acronyme;

                $liste[] = $type_contrat;
            }
        }
        return $liste;
    }

    public function getUnTypeContrat($id) {
        $requette = "select * from type_contrat where id = " . $id;
        $reponse = DB::select($requette);
        $type_contrat = null;
        if(count($reponse) > 0) {
            $type_contrat = new Type_Contrat();
            $type_contrat->id = $reponse[0]->id;
            $type_contrat->nom = $reponse[0]->nom;
            $type_contrat->acronyme = $reponse[0]->acronyme;
        }
        return $type_contrat;
    }
}