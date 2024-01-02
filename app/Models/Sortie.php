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

    public function getTypesSortie(){
        $request = "select * from type_sortie";
        $reponse = DB::select($request);
        return $reponse;
    }

    public function insertSortie(){
        $sql = "insert into sortie(dates, entre, article, quantite,types_sortie) values('".$this->dates."', '".$this->entre."','".$this->article."',".$this->quantite.",".$this->types.")";
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
}