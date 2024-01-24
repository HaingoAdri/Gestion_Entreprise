<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;


class Description extends Model
{
    public $id;
    public $description;

    public function __construct($id = "", $description = "") {
        $this->id = $id;
        $this->description = $description;
    }

    public function ajouter($idCategorie) {
        try {
            $requete = "insert into description(idcategorie, description) values ('".$idCategorie."','".$this->description."')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible to insert description: ".$e->getMessage());
        }    
    }

    public function getListeDescription($idCategorie) {
        $requette = "select * from description where idCategorie = '$idCategorie' order by description";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $description = new description($resultat->id, $resultat->description);
                $liste[] = $description;
            }
        }
        return $liste;
    }

}

