<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Importez la classe DB


class Explication extends Model
{
    public $id;
    public $motif;
    public $module;
    public $dates;
    public $reception;
    public $article;
    public $quantite;

    public function __construct($id="",$motif="",$module="",$dates="",$reception="",$article="",$quantite=""){
        $this->id = $id;
        $this->motif = $motif;
        $this->module = $module;
        $this->dates = $dates;
        $this->reception = $reception;
        $this->article = $article;
        $this->quantite = $quantite;
    }

    public function getAllExplication(){
        $requette = "select * from explication";
        $reponse = DB::select($requette);
        $liste = array();
        if(count($reponse)>0){
            foreach($reponse as $result){
                $explication = new Explication(id:$result->id,motif: $result->motif, module: $result->module, dates:$result->dates, reception: $result->reception, article:$result->article, quantite: $result->quantite);
                $liste[] = $explication;
            }
        }
        return $liste;
    }
}