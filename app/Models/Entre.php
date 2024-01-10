<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Entre extends Model
{
    public $id;
    public $dates;
    public $reception;
    public $article;
    public $quantite;
    public $prix_unitaire;
    public $montant;
    public $module;
    public $demande;

    public function __construct($id="",$dates="",$reception="",$article="",$quantite="",$prix_unitaire="",$montant="",$module="",$demande=""){
        $this->id = $id;
        $this->dates = $dates;
        $this->reception = $reception;
        $this->article = $article;
        $this->quantite = $quantite;
        $this->prix_unitaire = $prix_unitaire;
        $this->montant = $montant;
        $this->module = $module;
        $this->demande = $demande;
    }

    public function getReceptionDetails(){
        $requette = "select id,date_reception, article, quantite_article, prixunitaire, id_module,demande, module from details_bon";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse)>0){
            foreach($reponse as $result){
                $entre = new Entre(id:$result->id, dates:$result->date_reception, reception:$result->module, article:$result->article, quantite:$result->quantite_article, prix_unitaire:$result->prixunitaire,module:$result->id_module,demande:$result->demande);
                $liste[] = $entre;
            }
        }
        return $liste;
    }

    public function insertEntre(){
        try {
        $requette = "insert into entre (dates, reception, article, quantite, prix_unitaire, module) values('".$this->dates."', '".$this->reception."','".$this->article."',".$this->quantite.",".$this->prix_unitaire.",".$this->module.")";
        DB::insert($requette);
        echo $requette;
        } catch (Exception $e) {
            throw new Exception("Impossible d'inserer Entre: ".$e->getMessage());
        }
    }

    public function getAllEntre(){
        $requette = "select * from v_entre";
        $reponse = DB::select($requette);
        return $reponse;
    }

    public function rechercheEntre($entre,$dates,$datefin){
        $requette = "select * from v_entre where article = '".$entre." or dates >='".$dates."' and dates<='".$datesfin."'";
        $reponse = DB::select($requette);
        return $reponse;
    }

    public function getEntreMethodFifo($article){
        $requette = "select * from entre where article = '".$article."' order by dates  asc";
        $reponse = DB::select($requette);
        return $reponse;
    }

    public function getEntreMethodLifo($article){
        $requette = "select * from entre where article = '".$article."' order by dates desc";
        $reponse = DB::select($requette);
        return $reponse;
    }

    public function getEntreMethodFifoAchat($article){
        $requette = "select * from entre where article = '".$article."' and module = 8 order by dates  asc";
        $reponse = DB::select($requette);
        return $reponse;
    }

    public function getEntreMethodLifoAchat($article){
        $requette = "select * from entre where article = '".$article."' and module = 8 order by dates  desc";
        $reponse = DB::select($requette);
        return $reponse;
    }

    public function updateEntre($quantite,$entre,$dates){
        $sql = "update entre set quantite = ".$quantite." , dates = '".$dates."' where id = '".$entre."'";
        $reponse = DB::update($sql);
        return $reponse;
    }
}