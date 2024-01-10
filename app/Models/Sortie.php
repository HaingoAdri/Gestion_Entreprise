<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Sortie extends Model
{
    public $id;
    public $dates;
    public $entre;
    public $article;
    public $quantite;
    public $types;

    public function __construct($id="",$dates="",$entre="",$article="",$quantite="",$types=""){
        $this->id = $id;
        $this->dates = $dates;
        $this->entre = $entre;
        $this->article = $article;
        $this->quantite = $quantite;
        $this->types = $types;
    }

    public function setId() {
        $requette = "select coalesce(nextval('seqSortie'),1)";
        $reponse = DB::select($requette);
        $liste = array();
        $this->id = "S00";
        if(count($reponse) > 0){
            $this->id = $this->id . "" . $reponse[0]->coalesce;
        }

    }

    public function getTypesSortie(){
        $request = "select * from type_sortie order by types";
        $reponse = DB::select($request);
        return $reponse;
    }

    public function insertSortie(){
        $this->setId();
        $sql = "insert into sortie(id, dates, entre, article, quantite,types_sortie) values('$this->id', '".$this->dates."', '".$this->entre."','".$this->article."',".$this->quantite.",".$this->types.")";
        $reponse = DB::insert($sql);
        return $reponse;
    }

    public function makaSortie($entre){
        $sql = "select id from sortie where entre = '".$entre."'";
        $reponse = DB::select($sql);
        return $reponse;
    }

    public function getAllSortie(){
        $sql = "select * from v_sortie";
        $reponse = DB::select($sql);
        return $reponse;
    }

    public function sommeSortieAchat() {
        $requette = "select * from liste_total_sortie_article_achat where article = '".$this->article."'";
        $reponse = DB::select($requette);
        if(count($reponse)>0){
            return $reponse[0]->quantite;
        }
        return 0;
    }
    
    public function sommeSortieDepartement() {
        $requette = "select * from liste_total_sortie_article_departement where article = '".$this->article."'";
        $reponse = DB::select($requette);
        if(count($reponse)>0){
            return $reponse[0]->quantite;
        }
        return 0;
    }
}