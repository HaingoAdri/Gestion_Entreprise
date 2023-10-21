<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Type_Conge extends Model
{
    public $id;
    public $nom;
    public $politique;
    public $commentaires;

    public function __construct($nom = "", $politique = "", $commentaires = "") {
        $this->nom = $nom;
        $this->politique = $politique;
        $this->commentaires = $commentaires;
    }

    public function insertType_Conge() {
        try {

            $requete = "insert into type_conge(nom, politique, commentaires) values ('".$this->nom."','".$this->politique."','".$this->commentaires."')";
            DB::insert($requete);

        } catch (Exception $e) {
            throw new Exception("Impossible to insert Type_Conge: ".$e->getMessage());
        }    
    }

    public function getListeTypeConges() {
        $requette = "select * from type_conge";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $type_conge = new Type_Conge();
                $type_conge->id = $resultat->id;
                $type_conge->nom = $resultat->nom;
                $type_conge->politique = $resultat->politique;
                $type_conge->commentaires = $resultat->commentaires;

                $liste[] = $type_conge;
            }
        }
        return $liste;
    }

    public function getUnTypeConge($id) {
        $requette = "select * from type_conge where id = " . $id;
        $reponse = DB::select($requette);
        $type_conge = null;
        if(count($reponse) > 0) {
            $type_conge = new Type_Conge();
            $type_conge->id = $reponse->id;
            $type_conge->nom = $reponse->nom;
            $type_conge->politique = $reponse->politique;
            $type_conge->commentaires = $reponse->commentaires;
        }
        return $type_conge;
    }
}
