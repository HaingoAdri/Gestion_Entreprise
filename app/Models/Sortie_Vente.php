<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Sortie_Vente extends Model
{
    public $id;
    public $prix_unitaire;
    public $tva;
    public $prix_TTC;
    public $montant_Total;
    public $lieu_vente;
    public $numero;
    public $date;
    public $article;
    public $quantite;

    public function __construct($id="", $prix_unitaire="",$tva="",$prix_TTC="",$montant="",$lieu_vente="",$numero="", $date="",$article="",$quantite=""){
        $this->id = $id;
        $this->prix_unitaire = $prix_unitaire;
        $this->tva = $tva;
        $this->prix_TTC = $prix_TTC;
        $this->montant_Total = $montant;
        $this->lieu_vente = $lieu_vente;
        $this->numero = $numero;
        $this->date = $date;
        $this->article = $article;
        $this->quantite = $quantite;
    }

    public function setId() {
        $requette = "select coalesce(nextval('seqVente'),1)";
        $reponse = DB::select($requette);
        $liste = array();
        $this->id = "V00";
        if(count($reponse) > 0){
            $this->id = $this->id . "" . $reponse[0]->coalesce;
        }
    }

    public function insertSortieVente(){
        $this->setId();
        $this->prix_TTC = $this->prix_unitaire * (($this->tva + 100)/100);
        $this->montant_Total = $this->prix_TTC * $this->quantite;
        $sql = "insert into sortie_vente(id, lieu_vente, prix_unitaire, tva_origine, numero_caisse, date, article, quantite, prix_ttc, montanttotal) values ('$this->id', '".$this->lieu_vente."', ".$this->prix_unitaire.",".$this->tva.", '".$this->numero."', '".$this->date."', '".$this->article."', '".$this->quantite."', '$this->prix_TTC', '$this->montant_Total')";
        $insert = DB::insert($sql);
        return $insert;
    }

    public function getSortieVente(){
        $sql = "select * from V_Vente";
        $reponse = DB::select($sql);
        return $reponse;
    }

    
}