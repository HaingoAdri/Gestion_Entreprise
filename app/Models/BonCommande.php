<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class BonCommande extends Model
{
    public $id;
    public $date;
    public $idProformat;
    public $etat;

    public function insertBonCommande() {
        try {
            $requete = "insert into bon_commande (id, date, etat) values ('$this->id','$this->date', '$this->etat')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer un nouveau bon de commande: ".$e->getMessage());
        }    
    }

    public function insertDetailsCommande() {
        try {
            $requete = "insert into bon_commande (idboncommande, idproformat, etat) values ('$this->id','$this->idProformat', '$this->etat')";
            DB::insert($requete);
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer le details du bon de commande: ".$e->getMessage());
        }    
    }

    public function getListeModules() {
        $requette = "select * from module order by type asc";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse) > 0){
            foreach($reponse as $resultat) {
                $module = new Module();
                $module->id = $resultat->id;
                $module->type = $resultat->type;
                $liste[] = $module;
            }
        }
        return $liste;
    }

}
