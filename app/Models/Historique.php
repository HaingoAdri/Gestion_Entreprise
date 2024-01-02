<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Historique extends Model
{
    public $id;
    public $dates;
    public $entre;
    public $article;
    public $quantite;

    public function __construct($id="",$dates="",$entre="",$article="",$quantite=""){
        $this->id = $id;
        $this->dates = $dates;
        $this->entre = $entre;
        $this->article = $article;
        $this->quantite = $quantite;
    }

    public function insertHistorique(){
        $sql = "insert into historique(dates,entre,article,quantite) values ('".$this->dates."', '".$this->entre."', '".$this->article."',".$this->quantite.")";
        $reponse = DB::insert($sql);
        return $reponse;
    }

    public function getHistorique(){
        $sql = "select * from historique";
        $reponse = DB::select($sql);
        return $reponse;
    }
}