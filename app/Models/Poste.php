<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Poste extends Model
{
    public $id;
    public $type;

    public function insertPoste($type) {
        try {
            $requete = "insert into poste(type) values ('".$type."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert Poste: " . $e->getMessage());
        }    
    }

    public function getListePostes() {
        $requette = "select * from Poste";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $poste = new Poste();
                $poste->id = $resultat->id;
                $poste->type = $resultat->type;
                $liste[] = $poste;
            }
        }
        return $liste;
    }

    public function getUnePoste($id) {
        $requette = "select * from Poste where id = " . $id;
        $reponse = DB::select($requette);
        $poste = null;
        if(count($reponse) > 0) {
            $poste = new Poste();
            $poste->id = $reponse[0]->id;
            $poste->type = $reponse[0]->type;
        }
        return $poste;
    }
}
