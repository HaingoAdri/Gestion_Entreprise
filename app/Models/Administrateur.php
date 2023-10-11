<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Administrateur extends Model
{
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $mot_de_passe;
    public $module;

    public function insertAdministrateur($nom, $prenom, $email, $mot_de_passe, $idmodule) {
        try {
            $requete = "insert into administrateur(nom, prenom, email, mot_de_passe, idmodule) values ('".$nom."','".$prenom."','".$email."','".$mot_de_passe."',".$idmodule.")";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Administrateur: ".$e->getMessage());
        }    
    }

    public function getAdministrateur($email, $mot_de_passe) {
        $requette = "select * from Administrateur where email = '". $email . "' and mot_de_passe = '" . $mot_de_passe."'";
        $reponse = DB::select($requette);
        $administrateur = null;
        if(count($reponse) > 0){
            $administrateur = new Administrateur();
            $administrateur->id = $reponse[0]->id;
            $administrateur->nom = $reponse[0]->nom;
            $administrateur->prenom = $reponse[0]->prenom;
            $administrateur->email = $reponse[0]->email;
            $administrateur->mot_de_passe = $reponse[0]->mot_de_passe;
            $module = new Module();
            $administrateur->module = $module->getUneModule($reponse[0]->idmodule);
        }
        return $administrateur;
    }

    public function getListeAdministrateurs() {
        $requette = "select * from Administrateur";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $administrateur = new Administrateur();
                $administrateur->id = $resultat->id;
                $administrateur->nom = $resultat->nom;
                $administrateur->prenom = $resultat->prenom;
                $administrateur->email = $resultat->email;
                $module = new Module();
                $administrateur->module = $classe->getUneModule($resultat->idmodule);
                $liste[] = $administrateur;
            }
        }
        return $liste;
    }
}
